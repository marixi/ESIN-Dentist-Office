<?php

    function getRecordFromAppointmentsForDentist($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM record
                                JOIN appointment ON appointment_id=app_id
                                WHERE dentist_id = ?');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }
    
    function getRecordFromAppointmentsForClient($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM record
                                JOIN appointment ON record.appointment_id=app_id
                                JOIN person ON dentist_id=person.id
                                JOIN servicePerformed ON record.appointment_id=servicePerformed.appointment_id
                                JOIN service ON procedure=procedure_name
                                WHERE record.client_id = ?
                                ORDER BY date, time DESC;');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    function updateRecord($observations, $id_to_change) {
        global $dbh;
        $stmt = $dbh->prepare('UPDATE record SET observations = ? WHERE appointment_id = ?');
        $stmt->execute(array($observations, $id_to_change));
    }

?>