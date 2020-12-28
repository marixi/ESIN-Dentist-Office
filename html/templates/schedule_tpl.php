<?php

    if ($_SERVER['PHP_SELF'] == '/dentist.php') {
        $appointments = getDentistAppointments($_SESSION['id']);
    } else if ($_SERVER['PHP_SELF'] == '/dentalAuxiliary.php') {
        $appointments = getAuxiliariesAssignedAppointments($_SESSION['id']);
    }

    if (!isset($_SESSION['choice'])) {
        $_SESSION['choice'] = date('Y') . '-W' . date('W');
    }

?>

    <!-- Section regarding the schedule of the dentist -->
    <section id="Schedule">
        <h2> Schedule </h2>
        
        <!-- Define the week to display in the schedule -->
        <form action="action_changeWeeks.php" method="post">
            <input type="submit" name="interval" value="<">
            <?php
                $year = intval(substr($_SESSION['choice'], 0, 4));
                $week = substr($_SESSION['choice'], 6, 2);

                if ($_SESSION['choice'] == date('Y') . '-W' . date('W')) { ?>
                    <h1 id="scheduleTitle"> Current Week </h1> 
                <?php } else { ?>
                    <h1 id="scheduleTitle"> Week <?php echo $week ?> </h1> 
                <?php }
            ?>
            <input type="submit" name="interval" value=">">
        </form>

        <!-- Get the dates from the days of the chosen week and an array with the possible hours of work -->
        <?php 
            $monday = new DateTime();
            $monday->setISODate($year, $week, $dayOfWeek = 1);
            $tuesday = new DateTime();
            $tuesday->setISODate($year, $week, $dayOfWeek = 2);
            $wednesday = new DateTime();
            $wednesday->setISODate($year, $week, $dayOfWeek = 3);
            $thursday = new DateTime();
            $thursday->setISODate($year, $week, $dayOfWeek = 4);
            $friday = new DateTime();
            $friday->setISODate($year, $week, $dayOfWeek = 5);
            $saturday = new DateTime();
            $saturday->setISODate($year, $week, $dayOfWeek = 6);

            $hours = array('09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00');

        ?>

        <table id="scheduleTable">
            <tr>
                <th> </th>
                <th> Monday <p> <?php echo $monday->format('d-m-Y'); ?> </p> </th>
                <th> Tuesday <p> <?php echo $tuesday->format('d-m-Y'); ?> </p> </th>
                <th> Wednesday <p> <?php echo $wednesday->format('d-m-Y'); ?> </p> </th>
                <th> Thursday <p> <?php echo $thursday->format('d-m-Y'); ?> </p> </th>
                <th> Friday <p> <?php echo $friday->format('d-m-Y'); ?> </p> </th>
                <th> Saturday <p> <?php echo $saturday->format('d-m-Y'); ?> </p> </th>
            </tr>

            <!-- For each hour of every day of that week, create anchors to the existing appointments -->
            <?php foreach ($hours as $hour) { ?>
                <tr>
                    <th> <?php echo $hour ?> </th>
                    <td><?php find_appointment($monday->format('d-m-Y'), $hour, $appointments) ?></td>
                    <td><?php find_appointment($tuesday->format('d-m-Y'), $hour, $appointments) ?></td>
                    <td><?php find_appointment($wednesday->format('d-m-Y'), $hour, $appointments) ?></td>
                    <td><?php find_appointment($thursday->format('d-m-Y'), $hour, $appointments) ?></td>
                    <td><?php find_appointment($friday->format('d-m-Y'), $hour, $appointments) ?></td>
                    <td><?php find_appointment($saturday->format('d-m-Y'), $hour, $appointments) ?></td>
                </tr>
            <?php } ?>
            
        </table>
    </section>