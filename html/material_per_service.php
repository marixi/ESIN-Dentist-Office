<?php

    require_once('database/init_db.php');
    require_once('database/quantity_db.php');

    $quantity_list = getAllQuantities();

    include('templates/profile_header_tpl.php'); 
    include('templates/material_per_service_tpl.php'); 
    include('templates/footer_tpl.php'); 
    
?>