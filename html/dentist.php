<?php
    $dbh = new PDO('sqlite:sql/dentist_office.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt = $dbh->prepare('SELECT * FROM person JOIN employee USING (id) JOIN dentist USING (id) WHERE username = ? AND password = ?');
    $username = $_GET['username'];
    $password = $_GET['password'];
    $stmt->execute(array($username, $password));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/dentist.css" rel="stylesheet">
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
                <li><a href=#homepage.html title="Log Out"> Log Out </a></li>
            </ul>
        </nav>
    </header>

    <section id="dentistInfo">
        <?php while ($row = $stmt->fetch()) {?>
            <img src="images/<?php echo $row['username'] ?>.png" alt="Dr.<?php echo $row['name'] ?>">
            <h3> Name: </h3> 
            <p> <?php echo $row['name'] ?> </p>
            <h3> Address: </h3>
            <p> <?php echo $row['address'] ?> </p>
            <h3> Phone Number: </h3>
            <p> <?php echo $row['phone_number'] ?> </p>
            <h3> Date of Admission: </h3>
            <p> <?php echo $row['date_of_admission'] ?> </p>
        <?php } ?>
    </section>
</body>
</html>