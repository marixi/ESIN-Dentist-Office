<?php

    require_once('database/init_db.php');
    require_once('database/client_db.php');
    require_once('database/record_db.php');
    require_once('database/appointment_db.php');
    require_once('database/service_db.php');

    $id = $_SESSION['id'];

    $result = getCompletePastClientAppointments($id);
    
    $future = getCompleteFutureClientAppointments($id);

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
                            <li> <strong> Dentist Name: </strong> <?php echo $app['name'] ?> </li>  
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
                if (strtotime($app['date']) <= strtotime($date->format('d-m-yy'))) { 
                    $service = getServicePerformed($app['app_id']); ?>
                    <section id="appointment<?php echo $app['app_id'] ?>">
                        <h3> Appointment #<?php echo $app['app_id'] ?>: </h3>
                        <ul>
                            <li> <strong> Dentist Name: </strong> <?php echo $app['name'] ?> </li> 
                            <li> <strong> Date: </strong> <?php echo $app['date'] ?> </li> 
                            <li> <strong> Time: </strong> <?php echo $app['time'] ?> </li> 
                            <li> <strong> Specialty: </strong> <?php echo $app['specialty'] ?> </li>
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
                        </ul>
                        <form action="" method="post"> 
                            <p><strong>Observations:</strong></p>
                            <textArea readonly name="observations" rows="5" cols="50" ><?php echo getRecordFromAppointmentsForClient($id, $app['app_id'])['observations']; ?></textArea>
                        </form>
                    </section>
                <?php }
            } ?>
    </section>

    <?php include('templates/footer_tpl.php'); ?>