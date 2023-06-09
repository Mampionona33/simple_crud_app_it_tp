<?php
// require "./conn.php";

function create_table_users()
{
    require_once "./lib/create_table.php";
    $sql_users_col = "
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(30) NOT NULL,
    age INT(3) NOT NULL,
    sex BOOLEAN default 1,
    civilite VARCHAR(30) NOT NULL,
    email VARCHAR(30),
    adresse VARCHAR(30),
    tel VARCHAR(30)
    ";
    create_table("users", $sql_users_col);
    // $db = connect_db();

    // $sql = "CREATE TABLE IF NOT EXISTS users (
    // id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    // nom VARCHAR(30) NOT NULL,
    // prenom VARCHAR(30) NOT NULL,
    // age INT(3) NOT NULL,
    // sex BOOLEAN default 1,
    // civilite VARCHAR(30) NOT NULL,
    // email VARCHAR(30),
    // adresse VARCHAR(30),
    // tel VARCHAR(30)
    // );";

    // $db->exec($sql);
}

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

function create_user($user)
{
    $db = connect_db();
    $stmt = $db->prepare("INSERT INTO users (nom, prenom, age, sex, civilite, email, adresse, tel) 
                          VALUES (:nom, :prenom, :age, :sex, :civilite, :email, :adresse, :tel)");
    $stmt->bindParam(':nom', $user['nom']);
    $stmt->bindParam(':prenom', $user['prenom']);
    $stmt->bindParam(':age', $user['age'], PDO::PARAM_INT);
    $stmt->bindParam(':sex', $user['sex'], PDO::PARAM_INT);
    $stmt->bindParam(':civilite', $user['civilite'], PDO::PARAM_INT);
    $stmt->bindParam(':email', $user['email']);
    $stmt->bindParam(':adresse', $user['adresse']);
    $stmt->bindParam(':tel', $user['tel']);

    // Exécuter la requête SQL
    try {
        $stmt->execute();
        return $user;
    } catch (PDOException $e) {
        echo "Erreur lors de la création de l'utilisateur: " . $e->getMessage();
        exit();
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
        header("Location: .");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function update_user($user)
{

    $db = connect_db();
    try {
        $set_clause = '';
        foreach ($user as $key => $value) {
            if ($key !== 'id' && $key !== "action") {
                $set_clause .= "{$key}=:$key,";
            }
        }
        $set_clause = rtrim($set_clause, ','); // pour enlever la virgule à la fin
        $stmt = $db->prepare("UPDATE users SET {$set_clause} WHERE id=:id");

        $stmt->bindParam(':nom', $user['nom']);
        $stmt->bindParam(':prenom', $user['prenom']);
        $stmt->bindParam(':age', $user['age'], PDO::PARAM_INT);
        $stmt->bindParam(':sex', $user['sex'], PDO::PARAM_INT);
        $stmt->bindParam(':civilite', $user['civilite'], PDO::PARAM_INT);
        $stmt->bindParam(':email', $user['email']);
        $stmt->bindParam(':adresse', $user['adresse']);
        $stmt->bindParam(':tel', $user['tel']);
        $stmt->bindParam(':id', $user['id'], PDO::PARAM_INT);

        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
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
