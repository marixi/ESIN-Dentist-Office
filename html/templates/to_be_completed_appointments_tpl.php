<?php

    if (!isset($_SESSION['clientSearch'])) {
        $appointments = getNonCompletePastDentistAppointments($_SESSION['id']);
        $past = array_slice($appointments, ($_SESSION['past_page']-1)*3, 3);
        $_SESSION['max_past'] =  ceil(count($past)/3);
        $record = getRecordFromAppointmentsForDentist($_SESSION['id']);
    } else {
        $past = getNonCompletePastDentistAppointmentsForClient($_SESSION['id'], $_SESSION['clientSearch']);
        $record = getRecordFromAppointmentsForDentistOfClient($_SESSION['id'], $_SESSION['clientSearch']);
    }
   
?>

    <!-- Section to display the "to be completed" appointments -->
    <section class="appointment">

        <h2> To be completed </h2>

        <?php
        
            $date = new DateTime("now");
            foreach ($past as $app) { ?>

                <section id="appointment<?php echo $app['app_id'] ?>">

                    <h3> Appointment #<?php echo $app['app_id'] ?>: </h3>

                    <ul>
                        <li> <strong> Client Name: </strong> <?php echo $app['name'] ?> </li> 
                        <li> <strong> Date: </strong> <?php echo $app['date'] ?> </li> 
                        <li> <strong> Time: </strong> <?php echo $app['time'] ?> </li> 
                        <li> <strong> Specialty: </strong> <?php echo $app['specialty'] ?> </li>
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
                    </ul>

                    <!-- Select the service that was performed in the appointment -->
                    <?php $services = getServiceOfSpecialty($app['specialty']); ?> 
                    <form action="action_updateObservationsAndService.php" method="post">

                        <p><strong> Service Performed: </strong></p>
                        <select name="procedure">
                            <?php $i = 0; 
                            foreach ($services as $ser) { ?>
                                <option value=<?php echo $i ?>> <?php echo $ser['procedure_name']?> </option>
                                <?php $i = $i + 1;
                            } ?>
                        </select>

                        <!-- Write some observations about the appointment -->
                        <p><strong>Observations:</strong></p>
                        <textArea name="observations" rows="5" cols="50"><?php foreach ($record as $obs) { if ($obs['appointment_id'] == $app['app_id']) { echo $obs['observations']; } } ?></textArea>
                        <input type="hidden" name="specialty" value = <?php echo $app['specialty'] ?>>
                        <input type="hidden" name="appointment_to_change" value = <?php echo $app['app_id'] ?>>
                        <input type="submit" value="Update" id="update">

                    </form>

                </section>
            <?php } ?>

    </section>