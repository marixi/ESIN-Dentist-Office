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
                            ORDER BY app_id DESC');
        $stmt->execute(array($id));
        return $stmt->fetchAll();

    }

    function getCompleteFutureDentistAppointments($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM appointment
                            JOIN person ON client_id=person.id
                            WHERE dentist_id = ?
                            ORDER BY app_id ASC');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

    function getLastAppointment() {
        global $dbh;
        $stmt = $dbh->prepare('SELECT MAX(app_id) as maxId FROM appointment');
        $stmt->execute();   
        return $stmt->fetch();
    }

    function getCompleteFutureClientAppointments($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM appointment
                                JOIN person ON dentist_id=person.id
                                WHERE client_id = ?
                                ORDER BY date, time ASC;');
        $stmt->execute(array($id));
        return $stmt->fetchAll();
    }

?>