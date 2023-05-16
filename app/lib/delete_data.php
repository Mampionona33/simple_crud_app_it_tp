<?php 
function delete_data($nom_table, $condition)
{
    $db = connect_db();
    $stmt = $db->prepare("DELETE FROM $nom_table WHERE $condition");

    try {
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression des données : " . $e->getMessage();
        return false;
    }
}
