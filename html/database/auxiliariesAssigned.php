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

?>