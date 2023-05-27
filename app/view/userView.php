<?php


function user_table($users)
{
    $title = "List users";
    $content = '<form id="tableForm" method="post" action="/">';
    $content .= "<table>";
    $content .= "<tr><th><input type=\"checkbox\" name=\"selected_ids\" id=\"selected_ids\"></th><th>Noms</th><th>Prénoms</th><th>Actions</th> </tr>";

    if (empty($users)) {
        $content .= "<tr><td colspan='4'>No data found.</td></tr>";
    } else {
        foreach ($users as $user) {
            $content .= "<tr>";
            $content .= '<td><input title="select_user" placeholder="checkbox" type="checkbox" name="deleted_ids[]" value="' . $user["id"] . '"></td>';
            $content .= "<td>" . $user['nom'] . "</td>";
            $content .= "<td>" . $user['prenom'] . "</td>";
            $content .= "<td>";
            $content .= '<div class="cellContainer">';
            $content .= '<button type="button" title="Supprimer l\'element" class="button danger" name="delete_one" id="btn_delete_one' . $user["id"] . '" data-id="' . $user["id"] . '" data-user="' . $user["nom"] . ' ' . $user["prenom"] . '"><span class="material-icons-outlined">delete_outline</span></button>';
            $content .= '<div class="button" title="Details" ><a class="" href="/details/?id=' . $user['id'] . '"><span class="material-icons-outlined">info</span></a></div>';
            $content .= "</div>";
            $content .= "</td>";
            $content .= "</tr>";
        }
    }

    $content .= "</table>";
    $content .= '</form>';
    return [$title, $content];
}

function user_detail($user)
{
    $title = "Details sur " . $user[0]["prenom"];
    $content = '<div >';
    $content .= '<div class="card" >';
    $content .= '<p>Nom: <span>' . $user[0]['nom'] . '</span></p>';
    $content .= '<p>Prènom: <span>' . $user[0]['prenom'] . '</span></p>';
    $content .= '<p>Civilité: <span>' . $user[0]['civilite'] . '</span></p>';
    $content .= '<p>Age: <span>' . $user[0]['age'] . '</span></p>';
    $content .= '<p>Email: <span>' . $user[0]['email'] . '</span></p>';
    $content .= '<p>Tel: <span>' . $user[0]['tel'] . '</span></p>';
    $content .= '<p>Adresse: <span>' . $user[0]['adresse'] . '</span></p>';
    $content .= "</div>";
    $content .= "</div>";
    return [$title, $content];
}

function form_create()
{
    $title = "Create user";
    $content = '<div class="container">';
    $content .= '<form class="formulaire" method="post" action="/create" style="display: flex; flex-direction: column; gap: 1rem;">';
    $content .= '<input type="hidden" name="action" value="create">';
    $content .= '<div class="input-group">';
    $content .= '<label for="nom">Nom:</label>';
    $content .= '<input type="text" placeholder="Nom" required name="nom" id="nom">';
    $content .= '</div>';
    $content .= '<div class="input-group">';
    $content .= '<label for="prenom">Prénom:</label>';
    $content .= '<input type="text" placeholder="Prénom" required name="prenom" id="prenom">';
    $content .= '</div>';
    $content .= '<div class="input-group">';
    $content .= '<label for="date_naissance">Date de naissance:</label>';
    $content .= '<input type="date" required name="date_naissance" id="date_naissance">';
    $content .= '</div>';
    $content .= '<div class="input-group">';
    $content .= '<label for="email">Email:</label>';
    $content .= '<input type="email" placeholder="Email" name="email" id="email">';
    $content .= '</div>';
    $content .= '<div class="input-group">';
    $content .= '<label for="adresse">Adresse:</label>';
    $content .= '<input type="text" placeholder="Adresse" required name="adresse" id="adresse">';
    $content .= '</div>';
    $content .= '<div class="input-group">';
    $content .= '<label for="tel">Tel:</label>';
    $content .= '<input type="text" placeholder="Tel" name="tel" id="tel">';
    $content .= '</div>';
    $content .= '<div class="input-group">';
    $content .= '<label for="civilite">Civilité:</label>';
    $content .= '<select name="civilite" id="civilite" required>';
    $content .= '<option value="">Choisir une option</option>';
    $content .= '<option value="Mme">Madame</option>';
    $content .= '<option value="Mr">Monsieur</option>';
    $content .= '<option value="Mle">Mademoiselle</option>';
    $content .= '</select>';
    $content .= '</div>';
    $content .= '<input type="reset" value="Recommencer">';
    $content .= '<input type="submit" value="Créer" title="Créer un nouvel utilisateur">';
    $content .= "</form>";
    $content .= "</div>";

    return [$title, $content];
}

function msg_user_create($user)
{
    $message = '<div style="justify-content:center">';
    $message .= '<div class="alert">';
    $message .= '<p>' . $user["nom"] . ' ' . $user["prenom"] . ' a bien été ajouté(e) à la liste des utilisateurs.</p>';
    $message .= "</div>";
    $message .= "</div>";
    return $message;
}

function form_edit($user)
{
    $title = 'Edit User : ' . $user[0]["nom"];
    $content = '<div class="container">';
    $content .= '<form class="formulaire" method="post" action="/editUser/?id=' . $user[0]["id"] . '" style="display: flex; flex-direction: column; gap: 1rem;">';
    $content .= '<input type="hidden" name="action" value="edit">';
    $content .= '<input type="hidden" name="id" value="' . $user[0]["id"] . '">';
    $content .= '<div class="input-group">';
    $content .= '<label for="nom">Nom:</label>';
    $content .= '<input type="text" placeholder="Nom" required name="nom" id="nom" value="' . $user[0]['nom'] . '">';
    $content .= '</div>';
    $content .= '<div class="input-group">';
    $content .= '<label for="prenom">Prénom:</label>';
    $content .= '<input type="text" placeholder="Prénom" required name="prenom" id="prenom" value="' . $user[0]['prenom'] . '">';
    $content .= '</div>';
    $content .= '<div class="input-group">';
    $content .= '<label for="date_naissance">Date de naissance:</label>';
    $content .= '<input type="date" required name="date_naissance" id="date_naissance" value="' . $user[0]['date_naissance'] . '">';
    $content .= '</div>';
    $content .= '<div class="input-group">';
    $content .= '<label for="email">Email:</label>';
    $content .= '<input type="email" placeholder="Email" name="email" id="email" value="' . $user[0]['email'] . '">';
    $content .= '</div>';
    $content .= '<div class="input-group">';
    $content .= '<label for="adresse">Adresse:</label>';
    $content .= '<input type="text" placeholder="Adresse" required name="adresse" id="adresse" value="' . $user[0]['adresse'] . '">';
    $content .= '</div>';
    $content .= '<div class="input-group">';
    $content .= '<label for="tel">Tel:</label>';
    $content .= '<input type="text" placeholder="Tel" name="tel" id="tel" value="' . $user[0]['tel'] . '">';
    $content .= '</div>';
    $content .= '<div class="input-group">';
    $content .= '<label for="civilite">Civilité:</label>';
    $content .= '<select name="civilite" id="civilite" required>';
    $content .= '<option value="">Choisir une option</option>';
    $content .= '<option value="Mme" ' . ($user[0]['civilite'] == 'Mme' ? 'selected' : '') . '>Madame</option>';
    $content .= '<option value="Mr" ' . ($user[0]['civilite'] == 'Mr' ? 'selected' : '') . '>Monsieur</option>';
    $content .= '<option value="Mle" ' . ($user[0]['civilite'] == 'Mle' ? 'selected' : '') . '>Mademoiselle</option>';
    $content .= '</select>';
    $content .= '</div>';
    $content .= '<input type="reset" value="Recommencer">';
    $content .= '<input type="submit" value="Save" title="Enregistrer les modifications">';
    $content .= "</form>";
    $content .= "</div>";

    return [$title, $content];
}

function msg_user_updated_successful()
{

    $message = '<div class="container" style="justify-content:center">';
    $message .= '<div class="alert">';
    $message .= '<p>Les informations de l\'utilisateur ont été mises à jour avec succès.</p>';
    $message .= "</div>";
    $message .= "</div>";
    return $message;
}

function msg_delete_selected_successful()
{
    $message = '<div style="justify-content:center">';
    $message .= '<div class="alert">';
    $message .= '<p>Les éléments sélectionnés ont été supprimés de la liste avec succès..</p>';
    $message .= "</div>";
    $message .= "</div>";
    return $message;
}

function msg_delet_user_successfull()
{
    $message = '<div style="justify-content:center">';
    $message .= '<div class="alert">';
    $message .= '<p>L\'element a été supprimés de la liste avec succès..</p>';
    $message .= "</div>";
    $message .= "</div>";
    return $message;
}
