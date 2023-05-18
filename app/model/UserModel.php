<?php
require_once "./lib/get_data.php";
require_once "./lib/create_data.php";
require_once "./lib/update_data.php";

function create_table_users()
{
    require_once "./lib/create_table.php";
    $sql_users_col = "
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(30) NOT NULL,
    age INT(3) NOT NULL,
    civilite VARCHAR(30) NOT NULL,
    email VARCHAR(30),
    adresse VARCHAR(30),
    tel VARCHAR(30)
    ";
    create_table("users", $sql_users_col);
}

function get_users($filter = null, $age_min = null, $age_max = null)
{
    $nom_table = "users";
    $users = array();
    $query = "";
    if ($filter) {
        $searchConditions = [];
        $searchParams = ['nom', 'prenom', 'adresse'];
        foreach ($searchParams as $param) {
            $searchConditions[] = "$nom_table.$param LIKE '%$filter%'";
        }
        $query .= "WHERE " . implode(" OR ", $searchConditions);
    }

    if ($age_min !== null && $age_max !== null && $age_min !== '' && $age_max !== '') {
        if ($query) {
            $query .= " AND ";
        } else {
            $query = "WHERE ";
        }
        $query .= "$nom_table.age BETWEEN $age_min AND $age_max";
    }

    // var_dump($query);
    $data = get_data($nom_table, $query);
    foreach ($data as $row) {
        array_push($users, $row);
    }

    return $users;
}

function get_user($id)
{
    $user = [];
    $query = "WHERE id=$id";
    $data = get_data("users", $query);
    foreach ($data as $row) {
        array_push($user, $row);
    }
    return $user;
}

function create_user($user)
{
    $query = array($user);
    // Remove action from the query
    unset($query[0]["action"]);
    $created_user = create_data("users", $query[0]);
    if ($created_user) {
        return $created_user;
    }
}

function delete_users($users)
{
    $db = connect_db();
    try {
        $stmt = $db->prepare("DELETE FROM users WHERE id IN (" . implode(',', array_fill(0, count($users), '?')) . ")");
        $stmt->execute($users);
        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function delete_user($user)
{
    $db = connect_db();
    try {
        $stmt = $db->prepare("DELETE FROM users WHERE id IN (" . $user . ")");
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function update_user($user)
{
    $query = array($user);
    // Remove action from the query
    unset($query[0]["action"]);
    $nom_table = "users";
    if (update_data($nom_table, $query[0])) {
        return true;
    }
}

function pdf_list($users, $pdf_list)
{
    $pdf_list->AddPage();
    $pdf_list->SetFont("Arial", "B", 12);
    $pdf_list->SetRightMargin(20);

    $height = 10;
    $width = 95;

    $x = $pdf_list->GetX();
    $y = $pdf_list->GetY();

    $pdf_list->SetFillColor(224, 235, 255);
    $pdf_list->SetTextColor(0);
    $pdf_list->SetFont('');
    $pdf_list->Cell($width, $height, "Name", 1, 0, "C", true);
    $pdf_list->Cell($width, $height, "Last Name", 1, 0, "C", true);
    $pdf_list->Ln();

    foreach ($users as $row) {
        $pdf_list->Cell($width, $height, $row["nom"], 1, 0, "C", false);
        $pdf_list->Cell($width, $height, $row["prenom"], 1, 0, "C", false);
        $pdf_list->Ln();
    }

    $pdf_list->Output();
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
