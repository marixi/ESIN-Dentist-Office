<?php

    require_once('database/init.php');
    require_once('database/record.php');
    require_once('database/service.php');

    $procedure_name = $_POST['procedure_name'];
    $observations = $_POST['observations'];
    $id_to_change = $_POST['appointment_to_change'];

    updateRecord($observations, $id_to_change);
    updateServicePerformed($procedure_name, $id_to_change)

    header('Location: dentistAppointments.php');

?>