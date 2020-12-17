<?php 
    require_once('database/init.php');
    require_once('database/dentalAuxiliary.php');
    require_once('database/appointment.php');

    $id = $_SESSION['id'];

    $auxiliary = getAuxiliaryInfo($id);

    $future = getCompleteFutureAuxiliaryAppointments($id);
    
    $result = getCompleteFutureAuxiliaryAppointments($id);
    print_r($result);

    include('templates/dental_auxiliary_header_tpl.html');
    include('templates/dental_auxiliary_info_tpl.php');
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