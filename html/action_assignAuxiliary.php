<?php

    require_once('database/auxiliariesAssigned.php');

    $auxiliary = $_POST['auxiliary'];
    $appointment_to_change = $_POST['appointment_to_change'];

    assignAuxiliary($appointment_to_change, $auxiliary);

    header('Location: /dentistAppointments.php');

?>