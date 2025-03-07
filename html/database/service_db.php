<?php 

    function getAllServices() {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM service ORDER BY specialty_type');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getServiceOfSpecialty($specialty) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM service WHERE specialty_type = ?');
        $stmt->execute(array($specialty));
        return $stmt->fetchAll();
    }

    function updateServicePerformed($procedure, $id_to_change) {
        global $dbh;
        $stmt = $dbh->prepare('INSERT INTO servicePerformed (procedure, appointment_id) VALUES (?, ?)');
        $stmt->execute(array($procedure, $id_to_change));
    }

    function getServicePerformed($app_id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM servicePerformed
                                JOIN service ON procedure=procedure_name
                                WHERE appointment_id = ?;');
        $stmt->execute(array($app_id));
        return $stmt->fetch();
    }

?>