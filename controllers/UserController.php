<?php

require_once 'model/UserModel.php';
require_once 'view/userView.php';

function show_list()
{
    // Récupération des utilisateurs depuis la base de données
    $users = get_users();
    // Affichage de la liste des utilisateurs dans la vue
    user_table($users);
}

function show_details($id)
{
    $user =  get_user($id);
    user_detail($user);
}

function show_form_edit($id)
{
    $user =  get_user($id);
    form_edit($user);
}

function show_msg_user_created($user)
{
    $created_user = create_user($user);
    msg_user_create($created_user);
}

function show_msg_update_sucessfully($user)
{
    if (update_user($user)) {
        msg_user_updated_successful();
    }
}
