<?php

    require_once('database/init.php');
    require_once('database/dentist.php');
    require_once('database/appointment.php');

    $id = $_SESSION['id'];

    $dentist = getDentistInfo($id);

    $appointments = getDentistAppointments($id);

    if (!isset($_SESSION['choice'])) {
        $_SESSION['choice'] = date('Y') . '-W' . date('W');
    }

    require_once('templates/dentist_header_info_tpl.php');
    require_once('templates/schedule_tpl.php');
    require_once('templates/footer_tpl.php');
    
?>