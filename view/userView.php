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

function form_create()
{
    $title = "Create user";
    $content = "<div>";
    $content .= '<form method="post" action="/" style="display: flex; flex-direction: column; gap: 1rem;">';
    $content .= '<input type="hidden" name="action" value="create">';
    $content .= '<input type="text" placeholder="Nom" required name="nom" id="nom" >';
    $content .= '<input type="text" placeholder="Prénom" required name="prenom" id="prenom" >';
    $content .= '<input type="number" min=0  placeholder="Age" required name="age" id="age" >';
    $content .= '<input type="email" placeholder="Email" name="email" id="email" >';
    $content .= '<input type="text" placeholder="Adresse" name="adress" id="adress" >';
    $content .= '<input type="text" placeholder="Tel" name="tel" id="tel" >';
    $content .= '<div style="display: flex; gap: 1rem;">';
    $content .= '<div><input type="radio" name="civilite" value="0" id="civilite_mme" required> <label for="civilite_mme">Mme</label></div>';
    $content .= '<div><input type="radio" name="civilite" value="1" id="civilite_mr" checked required> <label for="civilite_mr">Mr</label></div>';
    $content .= '</div>';
    $content .= '<div style="display: flex; gap: 1rem;">';
    $content .= '<div><input type="radio" name="sex" value="0" id="sex_femme" required> <label for="sex_femme">Femme</label></div>';
    $content .= '<div><input type="radio" name="sex" value="1" id="sex_homme" checked required> <label for="sex_homme">Homme</label></div>';
    $content .= '</div>';
    $content .= '<input type="reset" value="Recommencer">';
    $content .= '<input type="submit" value="Créer">';
    $content .= "</form>";
    $content .= "</div>";
    include './template/template.php';
}
