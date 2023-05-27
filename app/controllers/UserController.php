<?php
require_once 'model/UserModel.php';
require_once 'view/userView.php';
require "./fpdf/fpdf.php";

function show_list($filter = null, $age_min = null, $age_max = null)
{
    // Récupération des utilisateurs depuis la base de données
    $users = get_users($filter, $age_min, $age_max);
    // Affichage de la liste des utilisateurs dans la vue
    $title = user_table($users)[0];
    $content = user_table($users)[1];
    return [$title, $content];
}

function show_form_create()
{
    $title = form_create()[0];
    $content = form_create()[1];
}

function show_details($id)
{
    $user =  get_user($id);
    if (isset($user)) {
        $data[] = $user[0];
        unset($data["age"]);

        $ageInSeconds = $user[0]["age"];
        $ageInYears = floor($ageInSeconds / (365 * 24 * 60 * 60)); // Conversion en années en arrondissant vers le bas
        $data[0]["age"] = $ageInYears;
        $title = user_detail($user)[0];
        $content = user_detail($data)[1];

        return [$title, $content];
    }
    return null;
}



function show_form_edit($id)
{
    $user =  get_user($id);
    if ($user) {
        // Calcul de la date de naissance à partir de l'âge en secondes
        if (isset($user[0]["age"])) {
            $currentDate = new DateTime();
            $interval = new DateInterval('PT' . $user[0]["age"] . 'S'); // Utiliser 'PT' pour les durées en secondes
            $interval->invert = 1; // Rend l'intervalle négatif
            $birthDate = $currentDate->add($interval)->format('Y-m-d');
            $user[0]["date_naissance"] = $birthDate;
        }
        $title = form_edit($user)[0];
        $content = form_edit($user)[1];
        return [$title, $content];
    }
    return null;
}





function show_msg_user_created($user)
{
    $created_user = create_user($user);
    return msg_user_create($created_user);
}

function show_msg_update_sucessfully($user)
{
    if (update_user($user)) {
        return  msg_user_updated_successful();
    }
}

function show_pdf_list($find, $age_min, $age_max)
{
    ob_start();
    $pdf_list = new FPDF();
    $users = get_users($find, $age_min, $age_max);
    if (count($users) > 0) {
        return  pdf_list($users, $pdf_list);
        ob_clean();
    }
}

function show_msg_delete_user($user_id)
{
    if (delete_user($user_id)) {
        return msg_delet_user_successfull();
    } else {
        return null;
    }
}
