<?php
    
    require_once('database/init_db.php');
    require_once('database/client_db.php');
    require_once('database/specialty_db.php');
    require_once('database/dentist_db.php');
    require_once('database/dentalAuxiliary_db.php');
    require_once('database/auxiliariesAssigned_db.php');
    require_once('database/appointment_db.php');

    $id = $_SESSION['id'];

    $specialties = getAllSpecialties();

    $dentists = getDentists();

    $max = getLastAppointment();

    include('templates/profile_header_tpl.php');
    include('templates/profile_info_tpl.php');
    include('templates/book_appointment_tpl.php'); 
    include('templates/footer_tpl.php'); 

?>