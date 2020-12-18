<?php

    if ($_SERVER['PHP_SELF'] == '/dentistAppointments.php') {
        $past = getCompletePastDentistAppointments($_SESSION['id']);
        $record = getRecordFromAppointmentsForDentist($_SESSION['id']);
    } else if ($_SERVER['PHP_SELF'] == '/dentalAuxiliary_appointments.php') {
        $past = getCompletePastAuxiliaryAppointments($_SESSION['id']);
    } else if ($_SERVER['PHP_SELF'] == '/clientRecord.php') {
        $past = getCompletePastClientAppointments($_SESSION['id']);
    }

?>

    <!-- Section to display the record of past appointments -->
    <section class="appointment">

        <h2> Past Appointments </h2>

        <?php
            $date = new DateTime("now");
            foreach ($past as $app) {
                if (($_SERVER['PHP_SELF'] == '/dentistAppointments.php' && strtotime($app['date']) <= strtotime($date->format('d-m-yy')) && $app['time'] <= date('H:i') && checkServicePerfomed($app['app_id']) ==  true) || ($_SERVER['PHP_SELF'] == '/dentalAuxiliary_appointments.php' || $_SERVER['PHP_SELF'] == '/clientRecord.php' && strtotime($app['date']) <= strtotime($date->format('d-m-yy')) && $app['time'] <= date('H:i') )) { ?>
                    
                    <section id="appointment<?php echo $app['app_id'] ?>">

                        <h3> Appointment #<?php echo $app['app_id'] ?>: </h3>

                        <ul>
                            <?php if ($_SERVER['PHP_SELF'] == '/dentistAppointments.php' || $_SERVER['PHP_SELF'] == '/dentistAppointments.php') { ?>
                                <li> <strong> Client Name: </strong> <?php echo $app['name'] ?> </li>
                            <?php } else if ($_SERVER['PHP_SELF'] == '/clientRecord.php') { ?> 
                                <li> <strong> Dentist Name: </strong> <?php echo $app['name'] ?> </li> 
                            <?php } ?>

                            <li> <strong> Date: </strong> <?php echo $app['date'] ?> </li> 
                            <li> <strong> Time: </strong> <?php echo $app['time'] ?> </li> 
                            <li> <strong> Specialty: </strong> <?php echo $app['specialty'] ?> </li>

                            <?php if ($_SERVER['PHP_SELF'] == '/dentistAppointments.php' || $_SERVER['PHP_SELF'] == '/dentistAppointments.php') { ?>
                                <li> <strong> Service Performed: </strong> <?php echo $app['procedure'] ?> </li>
                            <?php } else if ($_SERVER['PHP_SELF'] == '/clientRecord.php') {
                                 $service = getServicePerformed($app['app_id']); ?>
                                 <li> <strong> Service Performed: </strong> <?php echo $service['procedure'] ?> </li>
                                 <li> 
                                    <strong> Final Price: </strong> 
                                    <?php 
                                        if ($service) {
                                            $stmt = $dbh->prepare('SELECT percentage_discount FROM discount
                                                                    WHERE service_name = ? AND insurance_code = ?');
                                            $stmt->execute(array($service['procedure'], $row['insurance_code']));   
                                            $discount = $stmt->fetch();
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

                <?php }
            } ?>

    </section>