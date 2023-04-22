<?php

require_once 'model/UserModel.php';
require_once 'view/listUsers.php';

function show_list()
{
    // Récupération des utilisateurs depuis la base de données
    $users = get_users();

    // Affichage de la liste des utilisateurs dans la vue
    user_table($users);
}
