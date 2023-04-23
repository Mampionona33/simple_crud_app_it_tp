<?php
require "./conn.php";

function get_users()
{
    $db = connect_db();
    $users = array();
    $sql = "SELECT * FROM users";
    foreach ($db->query($sql) as $row) {
        // Modifier la valeur de la civilité
        if ($row['civilite'] == '1') {
            if ($row["sex"] == "1") {
                $row['civilite'] = 'Marié';
            } else {
                $row['civilite'] = 'Mariée';
            }
        } else {
            $row['civilite'] = 'Célibataire';
        }

        // Modifier le sex
        if ($row['sex'] == '1') {
            $row['sex'] = 'M';
        } else {
            $row['sex'] = 'F';
        }
        array_push($users, $row);
    }
    // var_dump($users);
    // die();
    return $users;
}
