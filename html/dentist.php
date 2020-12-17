<?php

    require_once('database/init.php');
    require_once('database/dentist.php');
    require_once('database/appointment.php');
    $id = $_SESSION['id'];
    $appointments = getDentistAppointments($id);

    if (!isset($_SESSION['choice'])) {
        $_SESSION['choice'] = date('Y') . '-W' . date('W');
    } 

    include('templates/profile_header_tpl.php');
    include('templates/profile_info_tpl.php');
    include('templates/schedule_tpl.php');
    include('templates/footer_tpl.php');
    
?>