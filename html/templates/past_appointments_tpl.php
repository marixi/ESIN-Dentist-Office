<?php
    
    if (isset($_POST['clientSearch'])) {
        $_SESSION['clientSearch'] = $_POST['clientSearch'];
    }

    if ($_SERVER['PHP_SELF'] == '/dentistAppointments.php') {
        if (!isset($_SESSION['clientSearch'])) {
            $data = getCompletePastDentistAppointments($_SESSION['id']);
            $appointments = getCompleted($data);
            $past = array_slice($appointments, ($_SESSION['past_page']-1)*3, 3);
            $_SESSION['max_past'] =  ceil(count($appointments)/3);
            $record = getRecordFromAppointmentsForDentist($_SESSION['id']);
        } else {
            $data = getCompletePastDentistAppointmentsForClient($_SESSION['id'], $_SESSION['clientSearch']);
            $past = getCompleted($data);
            $record = getRecordFromAppointmentsForDentistOfClient($_SESSION['id'], $_SESSION['clientSearch']);
        }
    } else if ($_SERVER['PHP_SELF'] == '/dentalAuxiliary_appointments.php') {
        if (!isset($_SESSION['clientSearch'])) {
            $appointments = getCompletePastAuxiliaryAppointments($_SESSION['id']);
            $past = array_slice($appointments, ($_SESSION['past_page']-1)*3, 3);
            $_SESSION['max_past'] =  ceil(count($appointments)/3);
        } else {
            $past = getCompletePastAuxiliaryAppointmentsForClient($_SESSION['id'], $_SESSION['clientSearch']);
        }  
    } else if ($_SERVER['PHP_SELF'] == '/clientRecord.php') {
        $appointments = getCompletePastClientAppointments($_SESSION['id']);
        $past = array_slice($appointments, ($_SESSION['past_page']-1)*3, 3);
        $_SESSION['max_past'] =  ceil(count($appointments)/3);
    }

?>

    <!-- Section to display the record of past appointments -->
    <section class="appointment">

        <h2> Past Appointments </h2>

        <?php
            $date = new DateTime("now");
            foreach ($past as $app) { ?>
                   
                <section id="appointment<?php echo $app['app_id'] ?>">

                    <h3> Appointment #<?php echo $app['app_id'] ?>: </h3>

                    <ul>
                        <?php if ($_SERVER['PHP_SELF'] == '/dentistAppointments.php' || $_SERVER['PHP_SELF'] == '/dentalAuxiliary_appointments.php') { ?>
                            <li> <strong> Client Name: </strong> <?php echo $app['name'] ?> </li>
                        <?php } else if ($_SERVER['PHP_SELF'] == '/clientRecord.php') { ?> 
                            <li> <strong> Dentist Name: </strong> <?php echo $app['name'] ?> </li> 
                        <?php } ?>

                        <li> <strong> Date: </strong> <?php echo $app['date'] ?> </li> 
                        <li> <strong> Time: </strong> <?php echo $app['time'] ?> </li> 
                        <li> <strong> Specialty: </strong> <?php echo $app['specialty'] ?> </li>

                        <?php if ($_SERVER['PHP_SELF'] == '/dentistAppointments.php' || $_SERVER['PHP_SELF'] == '/dentalAuxiliary_appointments.php') { ?>
                            <li> <strong> Service Performed: </strong> <?php echo $app['procedure'] ?> </li>
                        <?php } else if ($_SERVER['PHP_SELF'] == '/clientRecord.php') {
                            $service = getServicePerformed($app['app_id']); ?>
                            <li> <strong> Service Performed: </strong> <?php echo $service['procedure'] ?> </li>
                            <li> 
                                <strong> Final Price: </strong> 
                                <?php 
                                    if ($service) {
                                        $insurance = getClientInfo($_SESSION['id'])['insurance_code'];
                                        $discount = getDiscount($service['procedure'], $insurance);
                                        echo $service['price']-($discount['percentage_discount']*$service['price'])/100;
                                    }
                                ?> 
                            </li>
                        <?php } ?>

                        <?php if ($_SERVER['PHP_SELF'] == '/dentistAppointments.php') { ?>
                            <li> <strong> Auxiliary Assigned: </strong> 
                                <?php
                                    $assigned = getAuxiliariesAssignedForAppointment($app['app_id']); 
                                    $len = count($assigned);
                                    $i = 0;
                                    foreach ($assigned as $aux) {
                                        if ($i != $len - 1) { echo $aux['name']; echo ', '; }
                                        else { echo $aux['name']; }
                                        $i = $i + 1;
                                    } ?>   
                            </li>
                        <?php } ?>
                    </ul>

                    <?php if ($_SERVER['PHP_SELF'] == '/dentistAppointments.php') { ?>
                        <form action="action_updateObservations.php" method="post"> 
                            <p><strong>Observations:</strong></p>
                            <?php if ($_SERVER['PHP_SELF'] == '/dentistAppointments.php') { ?>
                                <textArea name="observations" rows="5" cols="50"><?php foreach ($record as $obs) { if ($obs['appointment_id'] == $app['app_id']) { echo $obs['observations']; } } ?></textArea>
                                <input type="hidden" name="appointment_to_change" value = <?php echo $app['app_id'] ?>>
                                <input type="submit" value="Update">
                            <?php } else if ($_SERVER['PHP_SELF'] == '/clientRecord.php') { ?>
                                <textArea readonly name="observations" rows="5" cols="50" ><?php echo getRecordFromAppointmentsForClient($id, $app['app_id'])['observations']; ?></textArea>
                            <?php } ?>
                        </form>
                        <?php } ?>

                </section>

            <?php } ?>

    </section>