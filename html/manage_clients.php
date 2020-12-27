<?php

    require_once('database/init_db.php');
    require_once('database/dentalAuxiliary_db.php');
    require_once('database/client_db.php');
    require_once('database/person_db.php');

    $id = $_SESSION['id'];
    $auxiliary = getAuxiliaryInfo($id);
    $clients = getClients();

    if (isset($_POST['remove_client'])) {
        unset($_SESSION['name']);
        unset($_SESSION['address']);
        unset($_SESSION['phone_number']);
        unset($_SESSION['date_of_birth']);
        unset($_SESSION['tax_number']);
        unset($_SESSION['insurance_code']);
        unset($_SESSION['username']);
        unset($_SESSION['password']);
    }

    include('templates/profile_header_tpl.php');
    include('templates/profile_info_tpl.php');
    include('templates/manage_clients_tpl.php'); 
    include('templates/footer_tpl.php'); 

?>