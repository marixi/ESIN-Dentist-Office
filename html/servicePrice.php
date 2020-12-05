<!-- Dentist Office -->
<!-- Authors: Duarte Rodrigues, Mariana Xavier -->

<?php
    $dbh = new PDO('sqlite:sql/dentist_office.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt = $dbh->prepare('SELECT * FROM service ORDER BY specialty_type');
    $stmt->execute();
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
        <a href='index.html' title="Home">
            <img src="images/logo.png" alt="Dentist Clinic Logo">
        </a>
        <nav>
            <ul>
                <li><a href='index.html' title="Home"> Home </a></li>
                <li><a href='index.html#services' title="Services"> Services </a></li>
                <li><a href='index.html#team' title="Team"> Meet the Team </a></li>
                <li><a href='index.html#contacts' title="Contacts"> Contacts </a></li>
                <li><a href="login.html"> Log In </a></li>
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
        <?php while ($row = $stmt->fetch()) {?>
                <tr>
                    <td> <?php echo $row['specialty_type'] ?> </td>
                    <td> <?php echo $row['procedure_name'] ?> </td>
                    <td id="price"> <?php echo $row['price'] ?> </td>
                </tr>
        <?php } ?>   
    </table> 
    
    <!-- Footer -->
    <footer>
        <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li>Price List</li>
        </ul>
        <p>&copy; Denticare Clinique, 2020</p>
    </footer>

</body>

</html>