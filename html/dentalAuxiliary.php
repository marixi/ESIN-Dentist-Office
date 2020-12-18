<?php

    require_once('database/init_db.php');
    require_once('database/dentalAuxiliary_db.php');
    require_once('database/auxiliariesAssigned_db.php');
    require_once('database/appointment_db.php');

    include('templates/profile_header_tpl.php'); 
    include('templates/profile_info_tpl.php'); 
    include('templates/schedule_tpl.php'); 
    include('templates/footer_tpl.php'); 
?>