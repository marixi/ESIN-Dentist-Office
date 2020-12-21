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
                <a href='/dentistAppointments.php' title="Appointment" style="color: black; text-decoration:none;"> #<?php echo $appointment['app_id']; ?>:
                <?php echo $appointment['specialty']; ?></a>
            <?php }
        }
    }

    function sortAppointments($appointments, $status) {
        $days = array_column($appointments, 'date');
        $hours = array_column($appointments, 'time');

        $i = 0;
        while ($i < count($days)) {
            $days[$i] = strtotime($days[$i]);
            $hours[$i] = strtotime($hours[$i]);
            $i++;
        }

        if ($status == 'past') { array_multisort($days, SORT_DESC, $hours, SORT_DESC, $appointments); }
        else if ($status == 'future') { array_multisort($days, SORT_ASC, $hours, SORT_ASC, $appointments); }

        return $appointments;
    }

    function selectOnlyFuture($data) {
        $date = new DateTime("now");
        $appointments = array();
        foreach ($data as $app) {
            if (strtotime($app['date']) > strtotime($date->format('d-m-yy')) || (strtotime($app['date']) == strtotime($date->format('d-m-yy')) && $app['time'] > date('H:i'))) {
                array_push($appointments, $app);
            }
        }
        return $appointments;
    }

    function selectOnlyPast($data) {
        $date = new DateTime("now");
        $appointments = array();
        foreach ($data as $app) {
            if (strtotime($app['date']) < strtotime($date->format('d-m-yy')) || (strtotime($app['date']) == strtotime($date->format('d-m-yy')) && $app['time'] <= date('H:i'))) {
                array_push($appointments, $app);
            }
        }
        return $appointments;
    }

    function getCompletePastDentistAppointments($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM appointment
                            JOIN person ON client_id=person.id
                            JOIN servicePerformed ON appointment_id=app_id
                            WHERE dentist_id = ?;');
        $stmt->execute(array($id));
        $data = $stmt->fetchAll();
        $appointments = selectOnlyPast($data);
        $appoitments = getCompleted($appointments);

        return sortAppointments($appointments, 'past');
    }

    function getNonCompletePastDentistAppointments($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM appointment
                            JOIN person ON client_id=person.id
                            WHERE dentist_id = ?;');
        $stmt->execute(array($id));
        $data = $stmt->fetchAll();
        $appointments = selectOnlyPast($data);
        $appointments = getToBeCompleted($appointments);

        return sortAppointments($appointments, 'past');
    }

    function getCompletePastDentistAppointmentsForClient($dentist_id, $client_id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM appointment
                            JOIN person ON client_id=person.id
                            JOIN servicePerformed ON appointment_id=app_id
                            WHERE dentist_id = ? AND client_id = ?;');
        $stmt->execute(array($dentist_id, $client_id));
        $data = $stmt->fetchAll();
        $appointments = selectOnlyPast($data);
        $appoitments = getCompleted($appointments);

        return sortAppointments($appointments, 'past');
    }

    function getNonCompletePastDentistAppointmentsForClient($dentist_id, $client_id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM appointment
                            JOIN person ON client_id=person.id
                            WHERE dentist_id = ? AND client_id = ?;');
        $stmt->execute(array($dentist_id, $client_id));
        $data = $stmt->fetchAll();
        $appointments = selectOnlyPast($data);
        $appointments = getToBeCompleted($appointments);

        return sortAppointments($appointments, 'past');
    }

    function getCompleteFutureDentistAppointments($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM appointment
                            JOIN person ON client_id=person.id
                            WHERE dentist_id = ?;');
        $stmt->execute(array($id));
        $data = $stmt->fetchAll();
        $appointments = selectOnlyFuture($data);

        return sortAppointments($appointments, 'future');
    }

    function getCompleteFutureDentistAppointmentsForClient($dentist_id, $client_id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM appointment
                            JOIN person ON client_id=person.id
                            WHERE dentist_id = ? AND client_id = ?;');
        $stmt->execute(array($dentist_id, $client_id));
        $data = $stmt->fetchAll();
        $appointments = selectOnlyFuture($data);

        return sortAppointments($appointments, 'future');
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
                                WHERE client_id = ?;');
        $stmt->execute(array($id));
        $data = $stmt->fetchAll();
        $appointments = selectOnlyPast($data);

        return sortAppointments($appointments, 'past');
    }

    function getCompleteFutureClientAppointments($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM appointment
                                JOIN person ON dentist_id=person.id
                                WHERE client_id = ?;');
        $stmt->execute(array($id));
        $data = $stmt->fetchAll();
        $appointments = selectOnlyFuture($data);

        return sortAppointments($appointments, 'future');
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
    }

    function getCompletePastAuxiliaryAppointments($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM auxiliariesAssigned
                                JOIN appointment ON auxiliariesAssigned.appointment_id=appointment.app_id
                                JOIN servicePerformed ON servicePerformed.appointment_id=auxiliariesAssigned.appointment_id
                                JOIN person ON client_id=person.id
                                WHERE auxiliary_id = ?');
        $stmt->execute(array($id));
        $data = $stmt->fetchAll();
        $appointments = selectOnlyPast($data);

        return sortAppointments($appointments, 'past');
    }

    function getCompletePastAuxiliaryAppointmentsForClient($aux_id, $client_id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM auxiliariesAssigned
                                JOIN appointment ON auxiliariesAssigned.appointment_id=appointment.app_id
                                JOIN servicePerformed ON servicePerformed.appointment_id=auxiliariesAssigned.appointment_id
                                JOIN person ON client_id=person.id
                                WHERE auxiliary_id = ? AND client_id = ?');
        $stmt->execute(array($aux_id, $client_id));
        $data = $stmt->fetchAll();
        return sortAppointments($data, 'past');
    }

    function getCompleteFutureAuxiliaryAppointments($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM auxiliariesAssigned
                                JOIN appointment ON appointment_id=app_id
                                JOIN person ON client_id=person.id
                                WHERE auxiliary_id = ?');
        $stmt->execute(array($id));
        $data = $stmt->fetchAll();
        $appointments = selectOnlyFuture($data);

        return sortAppointments($appointments, 'future');
    }

    function getCompleteFutureAuxiliaryAppointmentsForClient($aux_id, $client_id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM auxiliariesAssigned
                                JOIN appointment ON appointment_id=app_id
                                JOIN person ON client_id=person.id
                                WHERE auxiliary_id = ? AND client_id = ?');
        $stmt->execute(array($aux_id, $client_id));
        $data = $stmt->fetchAll();
        $appointments = selectOnlyFuture($data);

        return sortAppointments($appointments, 'future');
    }

    function getCompleted($array) {
        $appointments = array();
        foreach  ($array as $app) {
            if (checkServicePerfomed($app['app_id']) == true) {
                array_push($appointments, $app);
            }
        }
        return $appointments;
    }

    function getToBeCompleted($array) {
        $appointments = array();
        foreach  ($array as $app) {
            if (checkServicePerfomed($app['app_id']) == false) {
                array_push($appointments, $app);
            }
        }
        return $appointments;
    }

    function updatePrice($procedure_name, $id_to_change, $client_id) {
        global $dbh;
        
        $stmt = $dbh->prepare('SELECT price FROM service WHERE procedure = ?');
        $stmt->execute(array($procedure_name));
        $procedure_cost = $stmt->fetch()['price'];

        $insurance = getClientInfo($client_id)['insurance_code'];
        $discount = getDiscount($procedure_name, $insurance);

        $finalPrice = $procedure_cost - ($discount['percentage_discount']*$procedure_cost)/100;

        $stmt = $dbh->prepare('UPDATE appointment SET price = ? WHERE appointment_id = ?');
        $stmt->execute(array($finalPrice, $id_to_change));
    }

?>