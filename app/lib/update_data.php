<?php
function update_data($nom_table, $data)
{
    $db = connect_db();

    // Extraire l'ID de l'utilisateur
    $id = $data['id'];

    // Vérifier si l'ID existe déjà dans la table
    $existingUser = get_data($nom_table, "WHERE id = $id");
    if (empty($existingUser)) {
        echo "L'utilisateur avec l'ID $id n'existe pas.";
        return false;
    }

    // Construire la chaîne des colonnes et valeurs à mettre à jour
    $setColumns = array();
    foreach ($data as $column => $value) {
        $setColumns[] = "$column = :$column";
    }
    $setColumnsString = implode(", ", $setColumns);

    $stmt = $db->prepare("UPDATE $nom_table SET $setColumnsString WHERE id = $id");

    try {
        $stmt->execute($data);
        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de la mise à jour des données : " . $e->getMessage();
        return false;
    }
}
