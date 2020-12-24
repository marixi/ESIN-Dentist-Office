<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <link href="css/priceTable.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <title> Denticare Clinic Homepage </title>
</head>

<body>
    <!-- Header -->
    <header id="main">
        <a href='index.php' title="Home">
            <img src="images/Logo.png" alt="Dentist Clinic Logo" id="logo_img">
        </a>
        <nav>
            <ul>
                <li><a href='index.php' title="Home"> Home </a></li>
                <li><a href='index.php#services' title="Services"> Services </a></li>
                <li><a href='index.php#team' title="Team"> Meet the Team </a></li>
                <li><a href='index.php#contacts' title="Contacts"> Contacts </a></li>
                <?php if (isset($_SESSION['id'])) { ?>
                    <li><a href='action_decideProfile.php'> Profile </a></li>
                <?php } else { ?>
                    <li><a href="login.php"> Login </a></li>
                <?php } ?>
            </ul>
        </nav>
        <h1> Denticare Clinic </h1>
        <h2> Where your smile is art! </h2>
        <img src="images/header.jpg" alt="A crew happy to give you the perfect smile." id="beauty">
    </header>