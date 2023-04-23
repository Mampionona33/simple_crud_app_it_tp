<?php
require_once "./controllers/UserController.php";
$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

if ($uri == "/" || $uri == "/index.php" || $uri == "/list") {


    if (isset($_POST)) {
        if ($_POST["action"] == "create") {
            create_user($_POST);
        }
        if ($_POST['deleted_ids']) {
            delete_users($_POST["deleted_ids"]);
        }
    }

    show_list();
}


if ($uri == "/detail/") {
    if (isset($_GET['id'])) {
        $id = $_GET["id"];
        show_details($id);
    }
}

if ($uri == "/create") {
    form_create();
}
