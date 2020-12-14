<?php

    require_once('database/init.php');
    require_once('database/dentist.php');
    require_once('database/appointment.php');
    require_once('database/record.php');
    require_once('database/service.php');

    $id = $_SESSION['id'];

    $dentist = getDentistInfo($id);

    $result = getCompletePastDentistAppointments($id);

    $record = getRecordFromAppointmentsForDentist($id);

    $future = getCompleteFutureDentistAppointments($id);

    require_once('templates/dentist_header_info_tpl.php');
?>

    <!-- Section to display the list of future appointments -->
    <section class="appointment">
        <h2> Future Appointments </h2>
        <?php
            $date = new DateTime("now");
            foreach ($future as $app) {
                if (strtotime($app['date']) > strtotime($date->format('d-m-yy'))) { ?>
                    <section id="appointment<?php echo $app['app_id'] ?>">
                        <h3> Appointment #<?php echo $app['app_id'] ?>: </h3>
                        <ul>
                            <li> <strong> Client Name: </strong> <?php echo $app['name'] ?> </li> 
                            <li> <strong> Date: </strong> <?php echo $app['date'] ?> </li> 
                            <li> <strong> Time: </strong> <?php echo $app['time'] ?> </li> 
                            <li> <strong> Specialty: </strong> <?php echo $app['specialty'] ?> </li>
                        </ul>
                    </section>
                <?php }
            } ?>
    </section>

    <!-- Section to display the "to be completed" appointments -->
    <section class="appointment">
        <h2> To be completed </h2>
        <?php
            $date = new DateTime("now");
            foreach ($future as $app) {
                if (strtotime($app['date']) <= strtotime($date->format('d-m-yy')) && checkServicePerfomed($app['app_id']) ==  false) { ?>
                    <section id="appointment<?php echo $app['app_id'] ?>">
                        <h3> Appointment #<?php echo $app['app_id'] ?>: </h3>
                        <ul>
                            <li> <strong> Client Name: </strong> <?php echo $app['name'] ?> </li> 
                            <li> <strong> Date: </strong> <?php echo $app['date'] ?> </li> 
                            <li> <strong> Time: </strong> <?php echo $app['time'] ?> </li> 
                            <li> <strong> Specialty: </strong> <?php echo $app['specialty'] ?> </li>
                        </ul>
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
                            <p><strong>Observations:</strong></p>
                            <textArea name="observations" rows="5" cols="50"><?php foreach ($record as $obs) { if ($obs['appointment_id'] == $app['app_id']) { echo $obs['observations']; } } ?></textArea>
                            <input type="hidden" name="specialty" value = <?php echo $app['specialty'] ?>>
                            <input type="hidden" name="appointment_to_change" value = <?php echo $app['app_id'] ?>>
                            <input type="submit" value="Update">
                        </form>
                    </section>
                <?php }
            } ?>
    </section>

    <!-- Section to display the record of past appointments -->
    <section class="appointment">
        <h2> Past Appointments </h2>
        <?php
            $date = new DateTime("now");
            foreach ($result as $app) {
                if (strtotime($app['date']) <= strtotime($date->format('d-m-yy')) && checkServicePerfomed($app['app_id']) ==  true ) { ?>
                    <section id="appointment<?php echo $app['app_id'] ?>">
                        <h3> Appointment #<?php echo $app['app_id'] ?>: </h3>
                        <ul>
                            <li> <strong> Client Name: </strong> <?php echo $app['name'] ?> </li> 
                            <li> <strong> Date: </strong> <?php echo $app['date'] ?> </li> 
                            <li> <strong> Time: </strong> <?php echo $app['time'] ?> </li> 
                            <li> <strong> Specialty: </strong> <?php echo $app['specialty'] ?> </li>
                            <li> <strong> Service Performed: </strong> <?php echo $app['procedure'] ?> </li>
                        </ul>
                        <form action="action_updateObservations.php" method="post"> 
                            <p><strong>Observations:</strong></p>
                            <textArea name="observations" rows="5" cols="50"><?php foreach ($record as $obs) { if ($obs['appointment_id'] == $app['app_id']) { echo $obs['observations']; } } ?></textArea>
                            <input type="hidden" name="appointment_to_change" value = <?php echo $app['app_id'] ?>>
                            <input type="submit" value="Update">
                        </form>
                    </section>
                <?php }
            } ?>
    </section>

    <?php require_once('templates/footer_tpl.php'); ?>    