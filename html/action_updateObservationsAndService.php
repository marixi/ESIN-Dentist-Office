<?php

    require_once('database/init.php');
    require_once('database/record.php');
    require_once('database/service.php');

    $procedure = $_POST['procedure'];
    $specialty = $_POST['specialty'];
    $observations = $_POST['observations'];
    $id_to_change = $_POST['appointment_to_change'];
    $client_id = $_SESSION['id'];

    $services = getServiceOfSpecialty($specialty);
    $procedure_name = $services[$procedure]['procedure_name'];

    updateRecord($observations, $id_to_change, $client_id);
    updateServicePerformed($procedure_name, $id_to_change);


    /*$app_id = getAppointmentId($id, $date);*/
    /*$stmt = $dbh->prepare('INSERT INTO record (client_id, appointment_id, observations) VALUES (?, ?, NULL)');
        $stmt->execute(array($id, $app_id));*/

    header('Location: dentistAppointments.php');

?>