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
                    $message =  msg_delete_selected_successful();
                    header("Refresh:3; url=/");
                };
            }
            if (isset($_POST["delete_user_id"])) {
                $message = show_msg_delete_user($_POST["delete_user_id"]);
                header("Refresh:3; url=/");
            }
        }

        $title = show_list()[0];
        $content = show_list()[1];
        require_once "./template/template.php";
        break;
    case "/details/":
        if (isset($_POST['action']) && $_POST["action"] == "edit") {
            update_user($_POST);
        }

        if (isset($_GET['id'])) {
            header('Content-Type: text/html; charset=utf-8');
            $id = $_GET["id"];
            show_details($id);
        }
        break;

    case "/create":
        if (isset($_POST)) {
            if (isset($_POST["action"]) &&  $_POST["action"] == "create") {
                $message = show_msg_user_created($_POST);
                if ($message) {
                    // Redirection après 5 secondes
                    header("Refresh:3; url=/list");
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
                header("Refresh:5; url=/details/?id=" . $_POST['id']);
            }
        }

        if (isset($_GET["id"])) {
            header('Content-Type: text/html; charset=utf-8');
            $id = $_GET["id"];
            $title = show_form_edit($id)[0];
            $content = show_form_edit($id)[1];
        }
        require_once "./template/template.php";
        break;

    case "/dist/":
        header('Content-Type: application/javascript; charset=utf-8');
        readfile('dist/bundle.js');
        exit;
        break;

    case "/pdf_list":
        header("Content-Type: application/pdf");
        require_once "./fpdf/fpdf.php";
        show_pdf_list();
        var_dump(show_pdf_list());
        break;

    default:
        require_once "./model/page_not_fond.php";
        $content = page_not_fond();
        include_once "./template/template.php";
        break;
}
