<?php

    require_once('database/init_db.php');
    require_once('database/record_db.php');
    require_once('database/service_db.php');
    require_once('database/appointment_db.php');
    require_once('database/client_db.php');
    require_once('database/insurance_db.php');

    $procedure = $_POST['procedure'];
    $specialty = $_POST['specialty'];
    $observations = $_POST['observations'];
    $id_to_change = $_POST['appointment_to_change'];
    $client_id = $_SESSION['id'];

    $services = getServiceOfSpecialty($specialty);
    $procedure_name = $services[$procedure]['procedure_name'];

    updateRecord($observations, $id_to_change, $client_id);
    updateServicePerformed($procedure_name, $id_to_change);
    updatePrice($procedure_name, $id_to_change, $client_id);

    $go_back=$_SERVER['HTTP_REFERER'];
    header("Location: $go_back#appointment$id_to_change");

?>