<?php

    require_once('database/init.php');
    require_once('database/record.php');
    require_once('database/service.php');

    $procedure = $_POST['procedure'];
    $specialty = $_POST['specialty'];
    $observations = $_POST['observations'];
    $id_to_change = $_POST['appointment_to_change'];

    $services = getServiceOfSpecialty($specialty);
    $procedure_name = $services[$procedure]['procedure_name'];

    updateRecord($observations, $id_to_change);
    updateServicePerformed($procedure_name, $id_to_change);

    header('Location: dentistAppointments.php');

?>