<?php
require "./conn.php";

function get_users()
{
    $db = connect_db();
    $users = [];
    $sql = "SELECT * FROM users";
    foreach ($db->query($sql) as $row) {
        array_push($users, $row);
    }
    return $users;
}
