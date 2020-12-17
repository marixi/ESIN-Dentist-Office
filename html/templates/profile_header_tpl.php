<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <link href="css/profilePage.css" rel="stylesheet">
    <?php if ($_SERVER['PHP_SELF'] == '/dentist.php' || $_SERVER['PHP_SELF'] == '/dentistAppointments.php' || $_SERVER['PHP_SELF'] == '/manageTeam.php') { ?>
        <link href="css/dentistAppointments.css" rel="stylesheet">
        <link href="css/managePeople.css" rel="stylesheet">
    <?php } ?>
    <?php if ($_SERVER['PHP_SELF'] == '/dentalAuxiliary.php' || $_SERVER['PHP_SELF'] == '/dentalAuxiliary_appointments.php' || $_SERVER['PHP_SELF'] == '/manage_material.php' || $_SERVER['PHP_SELF'] == '/manage_clients.php') { ?>
        <link href="css/priceTable.css" rel="stylesheet">
        <link href="css/material.css" rel="stylesheet">
        <link href="css/mat_per_service.css" rel="stylesheet">
        <link href="css/dentistAppointments.css" rel="stylesheet">
    <?php } ?>
    <?php if ($_SERVER['PHP_SELF'] == '/client.php' || $_SERVER['PHP_SELF'] == '/clientRecord.php') { ?>
        <link href="css/bookAppointment.css" rel="stylesheet">
        <link href="css/dentistAppointments.css" rel="stylesheet">
    <?php } ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title> Profile </title>

</head>

<body>

    <!-- Header -->
    <header>
        <a href='index.php' title="Home">
            <img src="images/logo.png" alt="Dentist Clinic Logo">
        </a>
        <nav>
            <ul>
                <?php if ($_SERVER['PHP_SELF'] == '/dentist.php' || $_SERVER['PHP_SELF'] == '/dentistAppointments.php' || $_SERVER['PHP_SELF'] == '/manageTeam.php') { ?>
                    <li><a href='dentist.php' title="Profile"> Profile </a></li>
                    <li><a href='dentist.php#Schedule' title="Schedule"> Schedule </a></li>
                    <li><a href='dentistAppointments.php' title="Appointments"> Appointments </a></li>
                    <li><a href='manageTeam.php#team_mng' title="Manage Team"> Manage Team </a></li>
                    <li><a href='action_logout.php' title="Log Out"> Logout </a></li>
                <?php } ?>
                <?php if ($_SERVER['PHP_SELF'] == '/dentalAuxiliary.php' || $_SERVER['PHP_SELF'] == '/dentalAuxiliary_appointments.php' || $_SERVER['PHP_SELF'] == '/manage_material.php' || $_SERVER['PHP_SELF'] == '/manage_clients.php') { ?>
                    <li><a href='dentalAuxiliary.php' title="Profile"> Profile </a></li>
                    <li><a href='dentalAuxiliary.php#Schedule' title="Schedule"> Schedule </a></li>
                    <li><a href='dentalAuxiliary_appointments.php' title="Appointments"> Appointments </a></li>
                    <li><a href= 'manage_material.php' title="Material"> Manage Material </a></li>
                    <li><a href= 'manage_clients.php' title="Manage Clients"> Manage Clients </a></li>
                    <li><a href='action_logout.php' title="Logout"> Logout </a></li>
                <?php } ?>
                <?php if ($_SERVER['PHP_SELF'] == '/client.php' || $_SERVER['PHP_SELF'] == '/clientRecord.php') { ?>
                    <li><a href='client.php' title="Profile"> Profile </a></li>
                    <li><a href='\client.php#bookApp' title="Schedule"> Book Appointment </a></li>
                    <li><a href='clientRecord.php' title="Appointments"> Record </a></li>
                    <li><a href='action_logout.php' title="Log Out"> Logout </a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>