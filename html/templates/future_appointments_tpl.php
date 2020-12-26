<?php

    if (isset($_POST['clientSearch'])) {
        $_SESSION['clientSearch'] = $_POST['clientSearch'];
    }

    if ($_SERVER['PHP_SELF'] == '/dentistAppointments.php') {
        if (!isset($_SESSION['clientSearch'])) {
            $appointments = getCompleteFutureDentistAppointments($_SESSION['id']);
            $future = array_slice($appointments, ($_SESSION['future_page']-1)*3, 3);
            $_SESSION['max_future'] =  ceil(count($appointments)/3);
        } else {
            $future = getCompleteFutureDentistAppointmentsForClient($_SESSION['id'], $_SESSION['clientSearch']);
        }
        $auxiliaries = getAllAuxiliaries();
    } else if ($_SERVER['PHP_SELF'] == '/dentalAuxiliary_appointments.php') {
        if (!isset($_SESSION['clientSearch'])) {
            $appointments = getCompleteFutureAuxiliaryAppointments($_SESSION['id']);
            $future = array_slice($appointments, ($_SESSION['future_page']-1)*3, 3);
            $_SESSION['max_future'] =  ceil(count($appointments)/3);
        } else {
            $appointments = getCompleteFutureAuxiliaryAppointmentsForClient($_SESSION['id'], $_SESSION['clientSearch']);
        }  
    } else if ($_SERVER['PHP_SELF'] == '/clientRecord.php') {
        $appointments = getCompleteFutureClientAppointments($_SESSION['id']);
        $future = array_slice($appointments, ($_SESSION['future_page']-1)*3, 3);
        $_SESSION['max_future'] =  ceil(count($appointments)/3);
    }

?>

    <!-- Section to display the list of future appointments -->
    <section class="appointment">

        <h2> Future Appointments </h2>

        <?php
            $date = new DateTime("now");
            foreach ($future as $app) { ?>
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
                        <?php if ($_SERVER['PHP_SELF'] == '/dentistAppointments.php') { ?>
                            <li> <strong> Auxiliary Assigned: </strong> 
                            <?php
                                $assigned = getAuxiliariesAssignedForAppointment($app['app_id']); 
                                $len = count($assigned);
                                $i = 0;
                                if (!empty($assigned)) {
                                    foreach ($assigned as $aux) {
                                        if ($i != $len - 1) { echo $aux['name']; echo ', '; }
                                        else { echo $aux['name']; }
                                        $i = $i + 1;
                                    }
                                } else { ?>
                                    <form action="action_assignAuxiliary.php" method="post">
                                        <?php foreach ($auxiliaries as $aux) { 
                                            if (checkAuxiliaryAvailability($aux['id'], $app['date'], $app['time']) && $aux['id']!=$app['id']) { ?>
                                                <input type="checkbox" name="auxiliary[]" value=<?php echo $aux['id'] ?>> <?php echo $aux['name']?> </input>
                                            <?php }
                                        } ?>
                                    </select>
                                    <input type="hidden" name="appointment_to_change" value = <?php echo $app['app_id'] ?>>
                                    <input type="submit" value="Update">
                                    </form>
                                <?php } 
                            } ?>     
                        </li>
                    </ul>
                </section>

            <?php } ?>

    </section>