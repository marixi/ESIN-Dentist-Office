<?php
    session_start();

    $dbh = new PDO('sqlite:sql/dentist_office.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $id = $_SESSION['id'];

    $stmt1 = $dbh->prepare('SELECT * FROM person
                            JOIN employee USING (id) 
                            WHERE id = ?');
    $stmt1->execute(array($id));
    $row = $stmt1->fetch();

    $stmt2 = $dbh->prepare('SELECT * FROM appointment
                            JOIN person ON client_id=person.id
                            WHERE dentist_id = ?
                            ORDER BY app_id DESC');
    $stmt2->execute(array($id));
    $result = $stmt2->fetchAll();

    $stmt3 = $dbh->prepare('SELECT * FROM record
                            JOIN appointment ON appointment_id=app_id
                            WHERE dentist_id = ?');
    $stmt3->execute(array($id));
    $record = $stmt3->fetchAll();

    $stmt4 = $dbh->prepare('SELECT * FROM appointment
                            JOIN person ON client_id=person.id
                            WHERE dentist_id = ?
                            ORDER BY app_id ASC');
    $stmt4->execute(array($id));
    $future = $stmt4->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <link href="css/profilePage.css" rel="stylesheet">
    <link href="css/dentistAppointments.css" rel="stylesheet">
    <title> Dentist </title>
</head>

<body>

    <!-- Header -->
    <header>
        <a href='index.php' title="Home" >
            <img src="images/logo.png" alt="Dentist Clinic Logo">
        </a>
        <nav>
            <ul>
                <li><a href='dentist.php' title="Profile"> Profile </a></li>
                <li><a href='/dentist.php#Schedule' title="Schedule"> Schedule </a></li>
                <li><a href='dentistAppontments.php' title="Appointments"> Appointments </a></li>
                <li><a href=#maganeTeam title="Manage Team"> Manage Team </a></li>
                <li><a href='action_logout.php' title="Log Out"> Logout </a></li>
            </ul>
        </nav>
    </header>

    <!-- Section to display the information about the dentist -->
    <h1 id="profileTitle"> Dentist </h1>
    <section id="profileInfo">
        <img src="images/<?php echo $row['username'] ?>.jpg" alt="<?php echo $row['name'] ?>">
        <div id="info">
            <p> <strong> Name: </strong> <?php echo $row['name'] ?> </p>
            <p> <strong> Address: </strong> <?php echo $row['address'] ?> </p>
            <p> <strong> Phone Number: </strong> <?php echo $row['phone_number'] ?> </p>
            <p> <strong> Date of Admission: </strong> <?php echo $row['date_of_admission'] ?> </p>      
        </div>    
    </section>

    <!-- Section to display the list of future appointments -->
    <section class="appointment">
        <h2> Future Appointments </h2>
        <?php
            $date = new DateTime("now");
            foreach ($future as $app) {
                if (strtotime($app['date']) > strtotime($date->format('d-m-yy'))) { ?>
                    <section id="appointment<?php echo $app['app_id'] ?>">
                        <h3> Appointment #<?php echo $app['app_id'] ?>: </h3>
                        <ul>
                            <li> <strong> Client Name: </strong> <?php echo $app['name'] ?> </li> 
                            <li> <strong> Date: </strong> <?php echo $app['date'] ?> </li> 
                            <li> <strong> Time: </strong> <?php echo $app['time'] ?> </li> 
                            <li> <strong> Specialty: </strong> <?php echo $app['specialty'] ?> </li>
                        </ul>
                    </section>
                <?php }
            } ?>
    </section>

    <!-- Section to display the record of past appointments -->
    <section class="appointment">
        <h2> Past Appointments </h2>
        <?php
            $date = new DateTime("now");
            foreach ($result as $app) {
                if (strtotime($app['date']) < strtotime($date->format('d-m-yy'))) { ?>
                    <section id="appointment<?php echo $app['app_id'] ?>">
                        <h3> Appointment #<?php echo $app['app_id'] ?>: </h3>
                        <ul>
                            <li> <strong> Client Name: </strong> <?php echo $app['name'] ?> </li> 
                            <li> <strong> Date: </strong> <?php echo $app['date'] ?> </li> 
                            <li> <strong> Time: </strong> <?php echo $app['time'] ?> </li> 
                            <li> <strong> Specialty: </strong> <?php echo $app['specialty'] ?> </li>
                        </ul>
                        <form action="action_updateObservations.php" method="post"> 
                            <p><strong>Observations:</strong></p>
                            <textArea name="observations" rows="5" cols="50"><?php foreach ($record as $obs) { if ($obs['appointment_id'] == $app['app_id']) { echo $obs['observations']; } } ?></textArea>
                            <input type="hidden" name="appointment_to_change" value = <?php echo $app['app_id'] ?>>
                            <input type="submit" value="Update">
                        </form>
                    </section>
                <?php }
            } ?>
    </section>

    <!-- Footer -->
    <footer>
        <ul class="breadcrumb">
            <li><a href='index.php'>Home</a></li>
            <li><a href='dentist.php'>Profile</a></li>
            <li>Appointments</li>
        </ul>
        <p>&copy; Denticare Clinique, 2020</p>
    </footer>

</body>

</html>