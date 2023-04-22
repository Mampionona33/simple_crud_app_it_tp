<?php

function user_table($users)
{
    $content = "<table>";
    $content .= "<tr><th>Nom</th><th>Prénom</th><th>Âge</th><th>Sexe</th></tr>";

    // Parcours des utilisateurs et affichage de chaque ligne du tableau
    foreach ($users as $user) {
        $content .= "<tr>";
        $content .= "<td>" . $user['nom'] . "</td>";
        $content .= "<td>" . $user['prenom'] . "</td>";
        $content .= "<td>" . $user['age'] . "</td>";
        $content .= "<td>" . $user['sex'] . "</td>";
        $content .= "</tr>";
    }

    // Fermeture du tableau
    $content .= "</table>";

    // Inclusion du contenu dans le template
    include './template/template.php';
}
