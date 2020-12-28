<?php
    
    require_once('database/init_db.php');
    require_once('database/dentist_db.php');
    require_once('database/dentalAuxiliary_db.php');
    require_once('database/person_db.php');
    require_once('database/insurance_db.php');

    include('templates/profile_header_tpl.php'); 
    include('templates/profile_info_tpl.php');
    include('templates/manage_team_tpl.php'); 
    include('templates/footer_tpl.php'); 
    
?>    