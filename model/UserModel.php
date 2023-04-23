<?php
require "./conn.php";

function get_users()
{
    $db = connect_db();
    $users = array();
    $sql = "SELECT * FROM users";
    foreach ($db->query($sql) as $row) {
        $out =   format_civilit_and_sex($row);
        array_push($users, $out);
    }
    return $users;
}

function get_user($id)
{
    $db = connect_db();
    $sql = "SELECT * FROM users WHERE id=$id";
    $user = [];
    foreach ($db->query($sql) as $row) {
        $out = format_civilit_and_sex($row);
        array_push($user, $out);
    }
    return $user;
}

function create($user)
{
    $db = connect_db();
    $sql = "INSERT INTO users (nom, prenom, age, sex, civilite,email,adresse,tel)
    VALUES ($user),";
}

// Utilities
function format_civilit_and_sex($row)
{
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
    return $row;
}
