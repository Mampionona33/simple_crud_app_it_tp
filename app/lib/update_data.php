<?php
function update_data($nom_table, $query)
{
    $db = connect_db();
    $stmt = $db->prepare("UPDATE $nom_table SET $query");

    try {
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de la mise à jour des données : " . $e->getMessage();
        return false;
    }
}
