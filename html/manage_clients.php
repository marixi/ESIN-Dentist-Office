<?php

    require_once('database/init_db.php');
    require_once('database/dentalAuxiliary_db.php');
    require_once('database/client_db.php');
    require_once('database/person_db.php');
    require_once('database/insurance_db.php');

    $id = $_SESSION['id'];
    $auxiliary = getAuxiliaryInfo($id);
    $clients = getClients();

    include('templates/profile_header_tpl.php');
    include('templates/profile_info_tpl.php');
    include('templates/manage_clients_tpl.php'); 
    include('templates/footer_tpl.php'); 

?>