<?php

    require_once('database/init.php');
    require_once('database/record.php');

    $observations = $_POST['observations'];
    $id_to_change = $_POST['appointment_to_change'];

    updateRecord($observations, $id_to_change);

    header('Location: dentistAppointments.php');
?>