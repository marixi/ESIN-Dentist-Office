<?php

    require_once('database/init.php');
    require_once('database/auxiliariesAssigned.php');

    $auxiliary = $_POST['auxiliary'];
    $appointment_to_change = $_POST['appointment_to_change'];

    $len = count($auxiliary);
    $i = 0;
    while ($i < $len) {
        
        assignAuxiliary($appointment_to_change, $auxiliary[$i]);
        $i++;
    }

    header('Location: /dentistAppointments.php');

?>