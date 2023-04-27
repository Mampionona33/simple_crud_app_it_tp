<?php
// Ajouter ce code au début de votre fichier
error_reporting(E_ALL);
ini_set('display_errors', '1');


require_once "./controllers/UserController.php";
$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

if ($uri == "/" || $uri == "/index.php" || $uri == "/list") {
    header('Content-Type: text/html; charset=utf-8');

    if (isset($_POST)) {
        if (isset($_POST['deleted_ids']) && $_POST['deleted_ids']) {
            delete_users($_POST["deleted_ids"]);
        }
        if (isset($_POST["delete_user_id"])) {
            delete_user($_POST["delete_user_id"]);
        }
    }

    show_list();
}

if ($uri == "/details/") {

    if (isset($_POST['action']) && $_POST["action"] == "edit") {
        update_user($_POST);
    }

    if (isset($_GET['id'])) {
        header('Content-Type: text/html; charset=utf-8');
        $id = $_GET["id"];
        show_details($id);
    }
}

if ($uri == "/create") {
    header('Content-Type: text/html; charset=utf-8');

    if (isset($_POST)) {
        if (isset($_POST["action"]) &&  $_POST["action"] == "create") {
            show_msg_user_created($_POST);
            // Redirection apres 5
            header("Refresh:5; url=/list");
        }
    }
    form_create();
}

if ($uri == "/editUser/") {

    if (isset($_POST)) {
        if (isset($_POST["action"]) && preg_match_all("/edit/i", $_POST["action"]) && $_POST["id"]) {
            show_msg_update_sucessfully($_POST);
            // Redirection apres 5
            header("Refresh:5; url=/details/?id=" . $_POST['id']);
        }
    }

    if (isset($_GET["id"])) {
        header('Content-Type: text/html; charset=utf-8');
        $id = $_GET["id"];
        show_form_edit($id);
    }
}

if ($uri == "/dist/") {
    header('Content-Type: application/javascript; charset=utf-8');
    readfile('dist/bundle.js');
    exit;
}

if ($uri == "/pdf_list") {
    header("Content-Type: application/pdf");
    require_once "./fpdf/fpdf.php";
    show_pdf_list();
    var_dump(show_pdf_list());
}
