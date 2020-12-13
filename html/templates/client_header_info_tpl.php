<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <link href="css/profilePage.css" rel="stylesheet">
    <link href="css/bookAppointment.css" rel="stylesheet">
    <link href="css/dentistAppointments.css" rel="stylesheet">
    <title> Client </title>

</head>

<body>

    <!-- Header -->
    <header>
        <a href='index.php' title="Home">
            <img src="images/logo.png" alt="Dentist Clinic Logo">
        </a>
        <nav>
            <ul>
                <li><a href='client.php' title="Profile"> Profile </a></li>
                <li><a href='\client.php#bookApp' title="Schedule"> Book Appointment </a></li>
                <li><a href='clientRecord.php' title="Appointments"> Record </a></li>
                <li><a href='action_logout.php' title="Log Out"> Logout </a></li>
            </ul>
        </nav>
    </header>

    <!-- Section to display the information about the client -->
    <h1 id="profileTitle"> Client </h1>
    <section id="profileInfo">
        <img src="images/<?php echo $client['username'] ?>.jpg" alt="<?php echo $client['name'] ?>">
        <div id="info">
            <p> <strong> Name: </strong> <?php echo $client['name'] ?> </p>
            <p> <strong> Address: </strong> <?php echo $client['address'] ?> </p>
            <p> <strong> Phone Number: </strong> <?php echo $client['phone_number'] ?> </p>
            <p> <strong> Birth Date: </strong> <?php echo $client['birth_date'] ?> </p>
            <p> <strong> Tax Number: </strong> <?php echo $client['tax_number'] ?> </p>
            <p> <strong> Insurance: </strong> <?php echo $client['insurance_code'] ?> </p>
        </div>
    </section>