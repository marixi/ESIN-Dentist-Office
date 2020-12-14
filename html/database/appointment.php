<?php 

    function getDentistAppointments($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM appointment 
                                JOIN person ON dentist_id=person.id 
                                WHERE dentist_id = ?');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    function find_appointment($day, $hour, $appointments) {
        foreach ($appointments as $appointment) {
            if ($appointment['date'] == $day && $appointment['time'] == $hour) { ?>
                <a href='/dentistAppointments.php#appointment<?php echo $appointment['app_id'] ?>' title="Appointment" style="color: black; text-decoration:none;"> #<?php echo $appointment['app_id']; ?>:
                <?php echo $appointment['specialty']; ?></a>
            <?php }
        }
    }

    function getCompletePastDentistAppointments($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM appointment
                            JOIN person ON client_id=person.id
                            JOIN servicePerformed ON appointment_id=app_id
                            WHERE dentist_id = ?
                            ORDER BY date DESC, time DESC;');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    function getCompleteFutureDentistAppointments($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM appointment
                            JOIN person ON client_id=person.id
                            WHERE dentist_id = ?
                            ORDER BY date ASC, time ASC;');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    function checkServicePerfomed($app_id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT procedure FROM servicePerformed WHERE appointment_id = ?');
        $stmt->execute(array($app_id));
        if ($services = $stmt->fetch()) { return true; }
        else { return false; }
    }

    function getLastAppointment() {
        global $dbh;
        $stmt = $dbh->prepare('SELECT MAX(app_id) as maxId FROM appointment');
        $stmt->execute();   
        return $stmt->fetch();
    }

    function getCompletePastClientAppointments($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM appointment
                                JOIN person ON dentist_id=person.id
                                WHERE client_id = ?
                                ORDER BY date DESC, time DESC;');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    function getCompleteFutureClientAppointments($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM appointment
                                JOIN person ON dentist_id=person.id
                                WHERE client_id = ?
                                ORDER BY date ASC, time ASC;');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    function getAppointmentId($client, $date) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT id FROM appointment
                                JOIN person ON client_id=person.id
                                WHERE client_id = ? AND date = ?;');
        $stmt->execute(array($client, $date));
        return $stmt->fetch();
    }

    function addNewAppointment($date, $time, $dentist, $id, $room, $specialty) {
        global $dbh;
        $stmt = $dbh->prepare('INSERT INTO appointment (date, time, room, client_id, dentist_id, specialty) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute(array($date, $time, $dentist, $id, $room, $specialty));

        $app_id = getAppointmentId($id, $date);
        $stmt = $dbh->prepare('INSERT INTO record (client_id, appointment_id, observations) VALUES (?, ?, NULL)');
        $stmt->execute(array($id, $app_id));
    }

?>