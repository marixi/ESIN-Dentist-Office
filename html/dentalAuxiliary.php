<?php

    require_once('database/init.php');
    require_once('database/dentalAuxiliary.php');
    require_once('database/auxiliariesAssigned.php');
    require_once('database/appointment.php');
    
    $id = $_SESSION['id'];

    $auxiliary = getAuxiliaryInfo($id);

    if (!isset($_SESSION['choice'])) {
        $_SESSION['choice'] = date('Y') . '-W' . date('W');
    }

    require_once('templates/dental_auxiliary_header_tpl.html'); 
    require_once('templates/dental_auxiliary_info_tpl.php'); 
    require_once('templates/schedule_tpl.php'); 
    require_once('templates/footer_tpl.php'); 
?>