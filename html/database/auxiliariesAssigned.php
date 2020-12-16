<?php

    function getAuxiliariesAssignedAppointments($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM auxiliariesAssigned
                                JOIN appointment ON appointment_id=app_id
                                JOIN person ON auxiliary_id=person.id
                                WHERE auxiliary_id = ?');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    function getAuxiliariesAssignedForAppointment($app_id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM auxiliariesAssigned
                                JOIN person ON auxiliary_id=person.id
                                WHERE appointment_id = ?');
        $stmt->execute(array($app_id));
        return $stmt->fetchAll();
    }

    function assignAuxiliary($app_id, $auxiliary) {
        global $dbh;
        $stmt = $dbh->prepare('INSERT INTO auxiliariesAssigned (appointment_id, auxiliary_id) VALUES (?, ?)');
        $stmt->execute(array($app_id, $auxiliary));
    }

    function checkAuxiliaryAvailability($aux_id, $date, $time) {
        global $dbh;
        $availability = true;
        $appointments = getAuxiliariesAssignedAppointments($aux_id);
        foreach ($appointments as $app) {
            if ($app['date'] == $date && $app['time'] == $time) {
                $availability = false;
            }
        }
        return $availability;
    }

?>