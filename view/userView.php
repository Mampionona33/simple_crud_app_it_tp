<?php

function user_table($users)
{
    $title = "List users";
    $content = '<form id="tableForm" method="post" action="/">';
    $content .= "<table>";
    $content .= "<tr><th><input type=\"checkbox\" name=\"selected_ids\" id=\"selected_ids\"  ></th><th>Noms</th><th>Prénoms</th><th>Actions</th> </tr>";

    foreach ($users as $user) {
        $content .= "<tr>";
        $content .= '<td><input title="select_user" placeholder="checkbox" type="checkbox" name="deleted_ids[]" value="' . $user["id"] . '"></td>';
        $content .= "<td>" . $user['nom'] . "</td>";
        $content .= "<td>" . $user['prenom'] . "</td>";
        $content .= "<td>";
        $content .= '<input type="button" name="delete_one" id="btn_delete_one' . $user["id"] . '" value="Delete" data-id="' . $user["id"] . '" data-user="' . $user["nom"] . " " . $user["prenom"] . '">';
        $content .= '<a href="/details/?id=' . $user['id'] . '">Details</a>';
        $content .= "</td>";
        $content .= "</tr>";
    }

    $content .= "</table>";
    $content .= '</form>';

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
    $content .= '<label for="nom">Nom</label><input type="text" placeholder="Nom" required name="nom" id="nom" >';
    $content .= '<label for="prenom">Prénom</label><input type="text" placeholder="Prénom" required name="prenom" id="prenom" >';
    $content .= '<label for="age">Age</label><input type="number" min=0 placeholder="Age" required name="age" id="age" >';
    $content .= '<label for="email">Email</label><input type="email" placeholder="Email" name="email" id="email" >';
    $content .= '<label for="adress">Adresse</label><input type="text" placeholder="Adresse" required name="adress" id="adress" >';
    $content .= '<label for="tel">Tel</label><input type="text" placeholder="Tel" name="tel" id="tel" >';
    $content .= '<div style="display: flex; gap: 1rem;">';
    $content .= '<div><input type="radio" name="civilite" value="0" id="celibataire" checked required> <label for="celibataire">Célibataire</label></div>';
    $content .= '<div><input type="radio" name="civilite" value="1" id="marie"  required> <label for="marie">Marié(e)</label></div>';
    $content .= '</div>';
    $content .= '<div style="display: flex; gap: 1rem;">';
    $content .= '<div><input type="radio" name="sex" value="0" id="sex_femme" required> <label for="sex_femme">Femme</label></div>';
    $content .= '<div><input type="radio" name="sex" value="1" id="sex_homme" checked required> <label for="sex_homme">Homme</label></div>';
    $content .= '</div>';
    $content .= '<input type="reset" value="Recommencer">';
    $content .= '<input type="submit" value="Créer" title="Créer un nouvel utilisateur">';
    $content .= "</form>";
    $content .= "</div>";
    include './template/template.php';
}


function form_edit($user)
{
    $title = 'Edit User : ' . $user[0]["nom"];
    header('Content-Type: text/html; charset=utf-8');
    $content = "<div>";
    $content .= '<form method="post" action="/details/?id=' . $user[0]['id'] . '" style="display: flex; flex-direction: column; gap: 1rem;">';
    $content .= '<input type="hidden" name="action" value="edit">';
    $content .= '<input type="hidden" name="id" value="' . $user[0]["id"] . '">';
    $content .= '<label for="nom">Nom:</label><input type="text" placeholder="Nom" required name="nom" id="nom" value="' . $user[0]['nom'] . '" >';
    $content .= '<label for="prenom">Prénom:</label><input type="text" placeholder="Prénom" required name="prenom" id="prenom" value="' . $user[0]['prenom'] . '" >';
    $content .= '<label for="age">Age:</label><input type="number" min=0  placeholder="Age" required name="age" id="age" value="' . $user[0]['age'] . '" >';
    $content .= '<label for="email">Email:</label><input type="email" placeholder="Email" name="email" id="email" value="' . $user[0]['email'] . '" >';
    $content .= '<label for="adress">Adresse:</label><input type="text" placeholder="Adresse" required name="adresse" id="adresse" value="' . $user[0]['adresse'] . '" >';
    $content .= '<label for="tel">Téléphone:</label><input type="text" placeholder="Tel" name="tel" id="tel" value="' . $user[0]['tel'] . '" >';
    $content .= '<div style="display: flex; gap: 1rem;">';
    $content .= '<div><input type="radio" name="civilite" value="0" id="celibataire" ' . (($user[0]['civilite'] == 0) ? 'checked' : '') . ' required> <label for="celibataire">Célibataire</label></div>';
    $content .= '<div><input type="radio" name="civilite" value="1" id="marie" ' . (($user[0]['civilite'] == 1) ? 'checked' : '') . ' required> <label for="marie">Marié(e)</label></div>';
    $content .= '</div>';
    $content .= '<div style="display: flex; gap: 1rem;">';
    $content .= '<div><input type="radio" name="sex" value="0" id="sex_femme" ' . (($user[0]['sex'] == 0) ? 'checked' : '') . ' required> <label for="sex_femme">Femme</label></div>';
    $content .= '<div><input type="radio" name="sex" value="1" id="sex_homme" ' . (($user[0]['sex'] == 1) ? 'checked' : '') . ' required> <label for="sex_homme">Homme</label></div>';
    $content .= '</div>';
    $content .= '<input type="reset" value="Recommencer">';
    $content .= '<input type="submit" value="Modifier">';
    $content .= "</form>";
    $content .= "</div>";
    include './template/template.php';
}
