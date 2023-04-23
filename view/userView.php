<?php

function user_table($users)
{
    $title = "List users";
    $content = "<table>";
    $content .= "<tr><th>Noms</th><th>Prénoms</th><th>Age</th><th>Actions</th> </tr>";

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


function user_detail($user)
{
    $title = "Details sur " . $user[0]["prenom"];
    $content = "<div>";
    $content .= '<p>Nom: <span>' . $user[0]['nom'] . '</span></p>';
    $content .= '<p>Prènom: <span>' . $user[0]['prenom'] . '</span></p>';
    $content .= '<p>Civilité: <span>' . $user[0]['civilite'] . '</span></p>';
    $content .= '<p>Sex: <span>' . $user[0]['sex'] . '</span></p>';
    $content .= '<p>Age: <span>' . $user[0]['age'] . '</span></p>';
    $content .= '<p>Email: <span>' . $user[0]['email'] . '</span></p>';
    $content .= '<p>Tel: <span>' . $user[0]['tel'] . '</span></p>';
    $content .= "</div>";
    include './template/template.php';
}
