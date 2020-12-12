<?php

    require_once('database/init.php');
    require_once('database/dentist.php');
    require_once('database/appointment.php');

    $id = $_SESSION['id'];

    $dentist = getDentistInfo($id);

    $appointments = getDentistAppointments($id);

    if (!isset($_SESSION['choice'])) {
        $_SESSION['choice'] = date('Y') . '-W' . date('W');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <link href="css/profilePage.css" rel="stylesheet">
    <title> Dentist </title>

</head>

<body>

    <!-- Header -->
    <header>
        <a href='index.php' title="Home">
            <img src="images/logo.png" alt="Dentist Clinic Logo">
        </a>
        <nav>
            <ul>
                <li><a href='dentist.php' title="Profile"> Profile </a></li>
                <li><a href=#Schedule title="Schedule"> Schedule </a></li>
                <li><a href='dentistAppointments.php' title="Appointments"> Appointments </a></li>
                <li><a href='manageTeam.php' title="Manage Team"> Manage Team </a></li>
                <li><a href='action_logout.php' title="Log Out"> Logout </a></li>
            </ul>
        </nav>
    </header>

    <!-- Section to display the information about the dentist -->
    <h1 id="profileTitle"> Dentist </h1>
    <section id="profileInfo">
        <img src="images/<?php echo $dentist['username'] ?>.jpg" alt="Dr.<?php echo $dentist['name'] ?>">
        <div id="info">
            <p> <strong> Name: </strong> <?php echo $dentist['name'] ?> </p>
            <p> <strong> Address: </strong> <?php echo $dentist['address'] ?> </p>
            <p> <strong> Phone Number: </strong> <?php echo $dentist['phone_number'] ?> </p>
            <p> <strong> Date of Admission: </strong> <?php echo $dentist['date_of_admission'] ?> </p>
        </div>
    </section>

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

    <!-- Footer -->
    <footer>
        <ul class="breadcrumb">
            <li><a href='index.php'>Home</a></li>
            <li><a href='dentist.php'>Profile</a></li>
            <li>Schedule</li>
        </ul>
        <p>&copy; Denticare Clinique, 2020</p>
    </footer>

</body>

</html>