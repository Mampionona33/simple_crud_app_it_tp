<?php
// view/list_user.php

function user_table($users)
{
    // Affichage de l'en-tête du tableau
    echo "<table>";
    echo "<tr><th>Nom</th><th>Prénom</th><th>Âge</th><th>Sexe</th></tr>";

    // Parcours des utilisateurs et affichage de chaque ligne du tableau
    foreach ($users as $user) {
        echo "<tr>";
        echo "<td>" . $user['nom'] . "</td>";
        echo "<td>" . $user['prenom'] . "</td>";
        echo "<td>" . $user['age'] . "</td>";
        echo "<td>" . $user['sex'] . "</td>";
        echo "</tr>";
    }

    // Fermeture du tableau
    echo "</table>";
}
