<?php

    function getRecordFromAppointmentsForDentist($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM record
                                JOIN appointment ON appointment_id=app_id
                                WHERE dentist_id = ?');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }
    
    function getRecordFromAppointmentsForClient($client_id, $app_id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT observations FROM record
                                JOIN appointment ON record.appointment_id=app_id
                                WHERE record.client_id = ? AND record.appointment_id = ?
                                ORDER BY date, time DESC;');
        $stmt->execute(array($client_id, $app_id));
        return $stmt->fetch();
    }

    function updateRecord($observations, $id_to_change) {
        global $dbh;
        $stmt = $dbh->prepare('UPDATE record SET observations = ? WHERE appointment_id = ?');
        $stmt->execute(array($observations, $id_to_change));
    }

?>