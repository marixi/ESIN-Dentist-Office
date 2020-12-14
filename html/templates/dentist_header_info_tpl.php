<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <link href="css/profilePage.css" rel="stylesheet">
    <link href="css/dentistAppointments.css" rel="stylesheet">
    <link href="css/managePeople.css" rel="stylesheet">
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
                <li><a href='dentist.php#Schedule' title="Schedule"> Schedule </a></li>
                <li><a href='dentistAppointments.php' title="Appointments"> Appointments </a></li>
                <li><a href='manageTeam.php#team_mng' title="Manage Team"> Manage Team </a></li>
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