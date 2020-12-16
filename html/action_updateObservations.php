<?php

    require_once('database/init.php');
    require_once('database/record.php');

    $observations = $_POST['observations'];
    $id_to_change = $_POST['appointment_to_change'];
    $client_id = $_SESSION['id'];

    updateRecord($observations, $id_to_change, $client_id);

    header('Location: dentistAppointments.php');
    
?>