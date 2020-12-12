<?php
    require_once('database/init.php');
    require_once('database/service.php');
    $services = getAllServices();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <link href="css/priceTable.css" rel="stylesheet">
    <title> Service Prices </title>
</head>

<body>
    <!-- Header -->
    <header>
        <a href='index.php' title="Home">
            <img src="images/logo.png" alt="Dentist Clinic Logo">
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
        <h1> Denticare Clinique </h1>
        <h2> Where your smile is art! </h2>
        <img src="images/header.jpg"
            alt="A crew happy to give you the perfect smile." id="beauty">
    </header>

    <!-- Table to display the services performed and respective prices -->
    <h1 id="tableTitle"> Prices </h1>
    <table>
        <tr>
            <th scope="col"> Specialty </th> <th scope="col"> Procedure </th> <th scope="col"> Price </th>
        </tr>
        <?php foreach ($services as $service) {?>
                <tr>
                    <td> <?php echo $service['specialty_type'] ?> </td>
                    <td> <?php echo $service['procedure_name'] ?> </td>
                    <td id="price"> <?php echo $service['price'] ?> </td>
                </tr>
        <?php } ?>
    </table> 
    
    <!-- Footer -->
    <footer>
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li>Price List</li>
        </ul>
        <p>&copy; Denticare Clinique, 2020</p>
    </footer>

</body>

</html>