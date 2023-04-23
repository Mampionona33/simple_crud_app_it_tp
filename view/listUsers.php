<?php

function user_table($users)
{
    $title = "List users";
    $content = "<table>";
    $content .= "<tr><th>Nom</th><th>Prénom</th><th>Age</th><th>Action</th> </tr>";

    // Parcours des utilisateurs et affichage de chaque ligne du tableau
    foreach ($users as $user) {
        $content .= "<tr>";
        $content .= "<td>" . $user['nom'] . "</td>";
        $content .= "<td>" . $user['prenom'] . "</td>";
        $content .= "<td>" . $user['age'] . "</td>";
        $content .= "<td>";
        $content .= '<form method="post" action="/"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="' . $user["id"] . '"><button type="submit">Delete</button></form>';
        $content .= '<a href="/detail/?id=' . $user['id'] . '">Details</a>';
        $content .= "</td>";
        $content .= "</tr>";
    }

    // Fermeture du tableau
    $content .= "</table>";

    // Inclusion du contenu dans le template
    include './template/template.php';
}
