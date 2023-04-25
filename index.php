<?php
require_once "./controllers/UserController.php";
$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

if ($uri == "/" || $uri == "/index.php" || $uri == "/list") {
    header('Content-Type: text/html; charset=utf-8');

    if (isset($_POST)) {
        if ($_POST['deleted_ids']) {
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
        if ($_POST["action"] == "create") {
            show_msg_user_created($_POST);
            // Redirection apres 8
            header("Refresh:8; url=/list");
        }
    }
    form_create();
}

if ($uri == "/editUser/") {
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
