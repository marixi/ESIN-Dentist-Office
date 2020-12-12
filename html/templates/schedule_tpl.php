<?php

    if ($_SERVER['PHP_SELF'] == '/dentist.php') {
        $appointments = getDentistAppointments($id);
    } else if ($_SERVER['PHP_SELF'] == '/dentalAuxiliary.php') {
        $appointments = getAuxiliariesAssignedAppointments($id);
    }

?>

    <!-- Section regarding the schedule of the dentist -->
    <section id="Schedule">
        <h2> Schedule </h2>
        
        <form action="action_changeWeeks.php" method="post">
            <input type="submit" name="interval" value="<">
            <?php
                $year = intval(substr($_SESSION['choice'], 0, 4));
                $week = substr($_SESSION['choice'], 6, 2);

                if ($_SESSION['choice'] == date('Y') . '-W' . date('W')) { ?>
                    <h1 id="tableTitle"> Current Week </h1> 
                <?php } else { ?>
                    <h1 id="tableTitle"> Week <?php echo $week ?> </h1> 
                <?php }
            ?>
            <input type="submit" name="interval" value=">">
        </form>

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
        ?>

        <table id="scheduleTable">
            <tr>
                <th> </th>
                <th> Monday <p> <?php if ($monday->format('d-m-Y') != '27-12--0001') {
                                    echo $monday->format('d-m-Y');
                                } ?> </p>
                </th>
                <th> Tuesday <p> <?php if ($tuesday->format('d-m-Y') != '28-12--0001') {
                                        echo $tuesday->format('d-m-Y');
                                    } ?> </p>
                </th>
                <th> Wednesday <p> <?php if ($wednesday->format('d-m-Y') != '29-12--0001') {
                                        echo $wednesday->format('d-m-Y');
                                    } ?> </p>
                </th>
                <th> Thursday <p> <?php if ($thursday->format('d-m-Y') != '30-12--0001') {
                                        echo $thursday->format('d-m-Y');
                                    } ?> </p>
                </th>
                <th> Friday <p> <?php if ($friday->format('d-m-Y') != '31-12--0001') {
                                    echo $friday->format('d-m-Y');
                                } ?> </p>
                </th>
                <th> Saturday <p> <?php if ($saturday->format('d-m-Y') != '01-01-0000') {
                                        echo $saturday->format('d-m-Y');
                                    } ?> </p>
                </th>
            </tr>
            <tr>
                <th> 09:00 </th> <?php $hour = '09:00' ?>
                <td><?php find_appointment($monday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($tuesday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($wednesday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($thursday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($friday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($saturday->format('d-m-Y'), $hour, $appointments) ?></td>
            </tr>
            <tr>
                <th> 10:00 </th> <?php $hour = '10:00' ?>
                <td><?php find_appointment($monday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($tuesday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($wednesday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($thursday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($friday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($saturday->format('d-m-Y'), $hour, $appointments) ?></td>
            </tr>
            <tr>
                <th> 11:00 </th> <?php $hour = '11:00' ?>
                <td><?php find_appointment($monday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($tuesday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($wednesday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($thursday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($friday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($saturday->format('d-m-Y'), $hour, $appointments) ?></td>
            </tr>
            <tr>
                <th> 12:00 </th> <?php $hour = '12:00' ?>
                <td><?php find_appointment($monday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($tuesday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($wednesday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($thursday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($friday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($saturday->format('d-m-Y'), $hour, $appointments) ?></td>
            </tr>
            <tr>
                <th> 13:00 </th> <?php $hour = '13:00' ?>
                <td><?php find_appointment($monday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($tuesday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($wednesday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($thursday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($friday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($saturday->format('d-m-Y'), $hour, $appointments) ?></td>
            </tr>
            <tr>
                <th> 14:00 </th> <?php $hour = '14:00' ?>
                <td><?php find_appointment($monday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($tuesday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($wednesday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($thursday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($friday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($saturday->format('d-m-Y'), $hour, $appointments) ?></td>
            </tr>
            <tr>
                <th> 15:00 </th> <?php $hour = '15:00' ?>
                <td><?php find_appointment($monday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($tuesday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($wednesday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($thursday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($friday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($saturday->format('d-m-Y'), $hour, $appointments) ?></td>
            </tr>
            <tr>
                <th> 16:00 </th> <?php $hour = '16:00' ?>
                <td><?php find_appointment($monday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($tuesday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($wednesday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($thursday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($friday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($saturday->format('d-m-Y'), $hour, $appointments) ?></td>
            </tr>
            <tr>
                <th> 17:00 </th> <?php $hour = '17:00' ?>
                <td><?php find_appointment($monday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($tuesday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($wednesday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($thursday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($friday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($saturday->format('d-m-Y'), $hour, $appointments) ?></td>
            </tr>
            <tr>
                <th> 18:00 </th> <?php $hour = '18:00' ?>
                <td><?php find_appointment($monday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($tuesday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($wednesday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($thursday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($friday->format('d-m-Y'), $hour, $appointments) ?></td>
                <td><?php find_appointment($saturday->format('d-m-Y'), $hour, $appointments) ?></td>
            </tr>
        </table>
    </section>