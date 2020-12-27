<?php
    
    require_once('database/init_db.php');
    require_once('database/dentist_db.php');
    require_once('database/dentalAuxiliary_db.php');
    require_once('database/person_db.php');

    $id = $_SESSION['id'];
  
    $auxiliaries = getAllAuxiliaries();

    if (isset($_POST['fire'])) {
        unset($_SESSION['name']);
        unset($_SESSION['address']);
        unset($_SESSION['phone_number']);
        unset($_SESSION['date_of_admission']);
        unset($_SESSION['salary']);
        unset($_SESSION['username']);
        unset($_SESSION['password']);
    }

    include('templates/profile_header_tpl.php'); 
    include('templates/profile_info_tpl.php');
    include('templates/manage_team_tpl.php'); 
    include('templates/footer_tpl.php'); 
    
?>    