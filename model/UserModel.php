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
        header("Location: .");
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
