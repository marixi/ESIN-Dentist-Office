<?php

    require_once('database/init.php');
    require_once('database/client.php');
    require_once('database/record.php');
    require_once('database/appointment.php');

    $id = $_SESSION['id'];

    $client = getClientInfo($id);

    $result = getRecordFromAppointmentsForClient($id);
    
    $future = getCompleteFutureClientAppointments($id);

    require_once('templates/client_header_info_tpl.php');
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
                if (strtotime($app['date']) < strtotime($date->format('d-m-yy'))) { ?>
                    <section id="appointment<?php echo $app['app_id'] ?>">
                        <h3> Appointment #<?php echo $app['app_id'] ?>: </h3>
                        <ul>
                            <li> <strong> Dentist Name: </strong> <?php echo $app['name'] ?> </li> 
                            <li> <strong> Date: </strong> <?php echo $app['date'] ?> </li> 
                            <li> <strong> Time: </strong> <?php echo $app['time'] ?> </li> 
                            <li> <strong> Specialty: </strong> <?php echo $app['specialty'] ?> </li>
                            <li> <strong> Service Performed: </strong> <?php echo $app['procedure'] ?> </li>
                            <li> 
                                <strong> Final Price: </strong> 
                                <?php 
                                    $stmt = $dbh->prepare('SELECT percentage_discount FROM discount
                                                            WHERE service_name = ? AND insurance_code = ?');
                                    $stmt->execute(array($app['procedure'], $row['insurance_code']));   
                                    $discount = $stmt->fetch();
                                    echo $app['price']-($discount['percentage_discount']*$app['price'])/100;
                                ?> 
                            </li>
                        </ul>
                        <form action="" method="post"> 
                            <p><strong>Observations:</strong></p>
                            <textArea readonly name="observations" rows="5" cols="50" ><?php echo $app['observations']; ?></textArea>
                        </form>
                    </section>
                <?php }
            } ?>
    </section>

    <?php require_once('templates/footer_tpl.php'); ?>