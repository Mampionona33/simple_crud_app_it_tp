<?php
require_once "./controllers/UserController.php";
$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

if ($uri == "/" || $uri == "/index.php" || $uri == "/list") {
    show_list();
}

if ($uri == "/detail/") {
    if (isset($_GET['id'])) {
        $id = $_GET["id"];
        show_details($id);
    }
}
