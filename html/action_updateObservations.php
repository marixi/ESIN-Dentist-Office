<?php
    $observations = $_POST['observations'];
    $id_to_change = $_POST['appointment_to_change'];

    $dbh = new PDO('sqlite:sql/dentist_office.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stmt = $dbh->prepare('UPDATE record SET observations = ? WHERE appointment_id = ?');
    $stmt->execute(array($observations, $id_to_change));

    header('Location: dentistAppointments.php');
?>