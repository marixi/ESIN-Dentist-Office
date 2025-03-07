<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <link href="css/profilePage.css" rel="stylesheet">
    <link href="css/appointments.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/responsive/layout_responsive.css" rel="stylesheet">
    <link href="css/responsive/style_responsive.css" rel="stylesheet">
    <link href="css/responsive/profilePage_responsive.css" rel="stylesheet">
    <link href="css/responsive/appointment_responsive.css" rel="stylesheet">

    <?php if ($_SERVER['PHP_SELF'] == '/dentist.php' || $_SERVER['PHP_SELF'] == '/dentistAppointments.php' || $_SERVER['PHP_SELF'] == '/manageTeam.php') { ?>
        <link href="css/schedule.css" rel="stylesheet">
        <link href="css/managePeople.css" rel="stylesheet">
        <link href="css/responsive/schedule_responsive.css" rel="stylesheet">
        <link href="css/responsive/managePeople_responsive.css" rel="stylesheet">
        <title> Dentist </title>
    <?php } ?>

    <?php if ($_SERVER['PHP_SELF'] == '/dentalAuxiliary.php' || $_SERVER['PHP_SELF'] == '/dentalAuxiliary_appointments.php' || $_SERVER['PHP_SELF'] == '/material_per_service.php' || $_SERVER['PHP_SELF'] == '/manage_material.php' || $_SERVER['PHP_SELF'] == '/manage_clients.php') { ?>
        <link href="css/schedule.css" rel="stylesheet">
        <link href="css/priceTable.css" rel="stylesheet">
        <link href="css/material.css" rel="stylesheet">
        <link href="css/mat_per_service.css" rel="stylesheet">
        <link href="css/managePeople.css" rel="stylesheet">
        <link href="css/responsive/schedule_responsive.css" rel="stylesheet">
        <link href="css/responsive/priceTable_responsive.css" rel="stylesheet">
        <link href="css/responsive/material_responsive.css" rel="stylesheet">
        <link href="css/responsive/mat_per_service_responsive.css" rel="stylesheet">
        <link href="css/responsive/managePeople_responsive.css" rel="stylesheet">
        <title> Dental Auxiliary </title>
    <?php } ?>

    <?php if ($_SERVER['PHP_SELF'] == '/client.php' || $_SERVER['PHP_SELF'] == '/clientRecord.php') { ?>
        <link href="css/bookAppointment.css" rel="stylesheet">
        <link href="css/responsive/bookAppointment_responsive.css" rel="stylesheet">
        <title> Client </title>
    <?php } ?>

</head>

<body>

    <!-- Header -->
    <header>
        <a href='index.php' title="Home">
            <img src="images/logo.png" alt="Dentist Clinic Logo">
        </a>
        <nav id="menu">
            <input type="checkbox" id="hamburger">
            <label class="hamburger" for="hamburger"></label>
            <ul>

                <?php if ($_SERVER['PHP_SELF'] == '/dentist.php' || $_SERVER['PHP_SELF'] == '/dentistAppointments.php' || $_SERVER['PHP_SELF'] == '/manageTeam.php') { ?>
                    <li><a href='dentist.php' title="Profile"> Profile </a></li>
                    <li><a href='dentist.php#Schedule' title="Schedule"> Schedule </a></li>
                    <li><a href='dentistAppointments.php#search' title="Appointments"> Appointments </a></li>
                    <li><a href='manageTeam.php#team_mng' title="Manage Team"> Manage Team </a></li>
                    <li><a href='action_logout.php' title="Log Out"> Logout </a></li>
                <?php } ?>

                <?php if ($_SERVER['PHP_SELF'] == '/dentalAuxiliary.php' || $_SERVER['PHP_SELF'] == '/dentalAuxiliary_appointments.php' || $_SERVER['PHP_SELF'] == '/material_per_service.php' || $_SERVER['PHP_SELF'] == '/manage_material.php' || $_SERVER['PHP_SELF'] == '/manage_clients.php') { ?>
                    <li><a href='dentalAuxiliary.php' title="Profile"> Profile </a></li>
                    <li><a href='dentalAuxiliary.php#Schedule' title="Schedule"> Schedule </a></li>
                    <li><a href='dentalAuxiliary_appointments.php#search' title="Appointments"> Appointments </a></li>
                    <li><a href='manage_material.php' title="Material"> Manage Material </a></li>
                    <li><a href='manage_clients.php#client_mng' title="Manage Clients"> Manage Clients </a></li>
                    <li><a href='action_logout.php' title="Logout"> Logout </a></li>
                <?php } ?>

                <?php if ($_SERVER['PHP_SELF'] == '/client.php' || $_SERVER['PHP_SELF'] == '/clientRecord.php') { ?>
                    <li><a href='client.php' title="Profile"> Profile </a></li>
                    <li><a href='\client.php#bookApp' title="Schedule"> Book Appointment </a></li>
                    <li><a href='clientRecord.php' title="Appointments"> Record of Appointments </a></li>
                    <li><a href='action_logout.php' title="Log Out"> Logout </a></li>
                <?php } ?>

            </ul>
        </nav>
    </header>