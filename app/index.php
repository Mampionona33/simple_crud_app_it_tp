<?php
// Ajouter ce code au début de votre fichier
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once "./controllers/UserController.php";
require_once "./model/UserModel.php";
require_once "./conn.php";


create_table_users();

$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);


switch ($uri) {
    case '/':
    case '/list':
    case 'index.php':
        header('Content-Type: text/html; charset=utf-8');

        if (isset($_POST)) {
            if (isset($_POST['deleted_ids']) && $_POST['deleted_ids']) {
                if (delete_users($_POST["deleted_ids"])) {
                    $message = msg_delete_selected_successful();
                    header("Refresh:3; url=/");
                }
            }
            if (isset($_POST["delete_user_id"])) {
                if (show_msg_delete_user($_POST["delete_user_id"])) {
                    $message = show_msg_delete_user($_POST["delete_user_id"]);
                    header("Refresh:3; url=/");
                }
            }
        }

        if (isset($_GET)) {
            if (isset($_GET["find"])) {
                $find = $_GET["find"];
                $age_min = isset($_GET["age_min"]) ? $_GET["age_min"] : "";
                $age_max = isset($_GET["age_max"]) ? $_GET["age_max"] : "";
                if (strlen($find) > 0 || $age_min !== "" || $age_max !== "") {
                    // var_dump($age_max, $age_min);
                    list($title, $content) = show_list($find, $age_min, $age_max);
                } else {
                    if ($age_min !== "" && $age_max !== "" && strlen($age_min) > 0 && strlen($age_max) > 0) {
                        if ($age_min > $age_max) {
                            $erreur = "L'âge min ne doit pas être supérieur à l'âge max";
                            header("Refresh:3; url=/");
                            exit;
                        } else {
                            list($title, $content) = show_list($find, $age_min, $age_max);
                        }
                    } else {
                        // Retourner à "/" si aucun argument de recherche n'est spécifié
                        header("Location: /");
                        exit;
                    }
                }
            } else {
                list($title, $content) = show_list();
            }
        }

        require_once "./template/template.php";
        break;

    case "/details/":
        if (isset($_POST['action']) && $_POST["action"] == "edit") {
            update_user($_POST);
        }

        if (isset($_GET['id'])) {
            header('Content-Type: text/html; charset=utf-8');
            $id = $_GET["id"];
            if (!$title = show_details($id)) {
                http_response_code(404);
                require_once "template/not_found.php";
            } else {
                $title = show_details($id)[0];
                $content = show_details($id)[1];
                require_once "./template/template.php";
            }
        }
        break;

    case "/create":
        if (isset($_POST)) {
            if (isset($_POST["action"]) &&  $_POST["action"] == "create") {
                $message = show_msg_user_created($_POST);
                if ($message) {
                    // Redirection après 2 secondes
                    header("Refresh:2; url=/list");
                }
            }
        }
        $title = form_create()[0];
        $content = form_create()[1];
        require_once "./template/template.php";
        break;

    case "/editUser/":
        if (isset($_POST)) {
            if (isset($_POST["action"]) && preg_match_all("/edit/i", $_POST["action"]) && $_POST["id"]) {
                $message = show_msg_update_sucessfully($_POST);
                // Redirection apres 5
                header("Refresh:3; url=/details/?id=" . $_POST['id']);
            }
        }

        if (isset($_GET["id"])) {
            header('Content-Type: text/html; charset=utf-8');
            $id = $_GET["id"];
            if (!show_form_edit($id)) {
                http_response_code(404);
                require_once "template/not_found.php";
            } else {
                $title = show_form_edit($id)[0];
                $content = show_form_edit($id)[1];
                require_once "./template/template.php";
            }
        }
        break;

    case "/dist/":
        header('Content-Type: application/javascript; charset=utf-8');
        readfile('dist/bundle.js');
        exit;
        break;

        case "/pdf_list/":
            if(isset($_GET)){
                $find = isset( $_GET["find"]) ? $_GET["find"] : null ;
                $age_min = isset($_GET["age_min"]) ? $_GET["age_min"] : null;
                $age_max = isset($_GET["age_max"]) ? $_GET["age_max"] : null;
                $users = get_users($find, $age_min, $age_max);
        
                require_once "./fpdf/fpdf.php";
                $pdf = new FPDF();
                // Générez le contenu du PDF en utilisant la fonction pdf_list
                pdf_list($users, $pdf);
            }
            break;
        

    default:
        http_response_code(404);
        require_once "template/not_found.php";
        break;
}
