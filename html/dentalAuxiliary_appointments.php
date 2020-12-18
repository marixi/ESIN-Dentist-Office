<?php 
    require_once('database/init_db.php');
    require_once('database/dentalAuxiliary_db.php');
    require_once('database/appointment_db.php');

    $id = $_SESSION['id'];

    $future = getCompleteFutureAuxiliaryAppointments($id);
    
    $result = getCompletePastAuxiliaryAppointments($id);

    include('templates/profile_header_tpl.php'); 
    include('templates/profile_info_tpl.php');
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

        <!-- Section to display the record of past appointments -->
        <section class="appointment">
        <h2> Past Appointments </h2>
        <?php
            $date = new DateTime("now");
            foreach ($result as $app) {
                if (strtotime($app['date']) <= strtotime($date->format('d-m-yy'))) { ?>
                    <section id="appointment<?php echo $app['app_id'] ?>">
                        <h3> Appointment #<?php echo $app['app_id'] ?>: </h3>
                        <ul>
                            <li> <strong> Client Name: </strong> <?php echo $app['name'] ?> </li> 
                            <li> <strong> Date: </strong> <?php echo $app['date'] ?> </li> 
                            <li> <strong> Time: </strong> <?php echo $app['time'] ?> </li> 
                            <li> <strong> Specialty: </strong> <?php echo $app['specialty'] ?> </li>
                            <li> <strong> Service Performed: </strong> <?php echo $app['procedure'] ?> </li>
                        </ul>
                    </section>
                <?php }
            } ?>
    </section>

    <?php include('templates/footer_tpl.php'); ?>    