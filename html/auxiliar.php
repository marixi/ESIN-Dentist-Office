<!-- Dentist Office -->
<!-- Authors: Duarte Rodrigues, Mariana Xavier -->

<?php
    $dbh = new PDO('sqlite:sql/dentist_office.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $username = $_GET['username'];
    $password = $_GET['password'];

    $stmt1 = $dbh->prepare('SELECT * FROM person 
                            JOIN employee USING (id) 
                            JOIN dentalAuxiliary USING (id) 
                            WHERE username = ? AND password = ?');
    $stmt1->execute(array($username, $password));
    $row = $stmt1->fetch();
    
    // $stmt2 = $dbh->prepare('SELECT * FROM appointment 
    //                         JOIN person ON dentist_id=person.id 
    //                         WHERE username = ? AND password = ?');
    // $stmt2->execute(array($username, $password));
    // $result = $stmt2->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <link href="css/dentistPage.css" rel="stylesheet">
    <title>Dental Auxiliary</title>
</head>
<body>
<!-- Header -->
<header>
        <img src="images/logo.png" alt="Dentist Clinic Logo">
        <nav>
            <ul>
                <li><a href='auxiliar.php' title="Profile"> Profile </a></li>
                <li><a href=#dentistShedule title="Schedule"> Schedule </a></li>
                <li><a href='dentistAppointments.php?id=<?php echo $row['id']?>' title="Appointments"> Appointments </a></li>
                <li><a href=#maganeStock title="Manage Stock"> Manage Team </a></li>
                <li><a href='homepage.html' title="Log Out"> Log Out </a></li>
            </ul>
        </nav>
    </header>

    <!-- Sectiom to display the information about the dentist -->
    <h1 id="dentistTitle"> Dentist </h1>
    <section id="dentistInfo">
        <img src="images/<?php echo $row['username'] ?>.jpg" alt="Dr.<?php echo $row['name'] ?>">
        <div id="info">
            <p> <strong> Name: </strong> <?php echo $row['name'] ?> </p>
            <p> <strong> Address: </strong> <?php echo $row['address'] ?> </p>
            <p> <strong> Phone Number: </strong> <?php echo $row['phone_number'] ?> </p>
            <p> <strong> Date of Admission: </strong> <?php echo $row['date_of_admission'] ?> </p>      
        </div>    
    </section>

    <!-- Footer -->
    <footer>
        <ul class="breadcrumb">
            <li>Profile</li>
        </ul>
        <p>&copy; Denticare Clinique, 2020</p>
    </footer>

    
</body>
</html>
