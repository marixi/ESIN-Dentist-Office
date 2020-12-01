<!-- Dentist Office -->
<!-- Authors: Duarte Rodrigues, Mariana Xavier -->

<?php
    $dbh = new PDO('sqlite:sql/dentist_office.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt = $dbh->prepare('SELECT * FROM person JOIN employee USING (id) JOIN dentist USING (id) WHERE username = ? AND password = ?');
    $username = $_GET['username'];
    $password = $_GET['password'];
    $stmt->execute(array($username, $password));
    $row = $stmt->fetch()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <link href="css/dentistStyle.css" rel="stylesheet">
    <title> Dentist </title>
</head>
<body>
    <!-- Header -->
    <header>
        <img src="images/logo.png" alt="Dentist Clinic Logo">
        <nav>
            <ul>
                <li><a href='dentist.php' title="Profile"> Profile </a></li>
                <li><a href=#schedule title="Schedule"> Schedule </a></li>
                <li><a href=#appointments title="Appointments"> Appointments </a></li>
                <li><a href=#maganeTeam title="Manage Team"> Manage Team </a></li>
                <li><a href='homepage.html' title="Log Out"> Log Out </a></li>
            </ul>
        </nav>
    </header>

    <!-- Sectiom to display the information about the dentist -->
    <section id="dentistInfo">
        <h1 id="dentistTitle"> Dentist </h1>
        <img src="images/<?php echo $row['username'] ?>.png" alt="Dr.<?php echo $row['name'] ?>">
        <table>
            <tr>
                <th scope="row">Name:</th> <td> <?php echo $row['name'] ?> </td>
            </tr>  
            <tr>
                <th scope="row">Address:</th> <td> <?php echo $row['address'] ?> </td>
            </tr>
            <tr>
                <th scope="row">Phone Number:</th> <td> <?php echo $row['phone_number'] ?> </td>
            </tr>
            <tr>
                <th scope="row">Date of Admission:</th> <td> <?php echo $row['date_of_admission'] ?> </td>
            </tr>    
        </table>
    </section>

    <!-- Section -->

    <!-- Footer -->
    <!--
    <footer>
        <ul class="breadcrumb">
            <li>Profile</li>
        </ul>
        <p>&copy; Denticare Clinique, 2020</p>
    </footer>-->

</body>

</html>