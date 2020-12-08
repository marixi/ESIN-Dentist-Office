<?php
    session_start();
    
    $dbh = new PDO('sqlite:sql/dentist_office.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $id = $_SESSION['id'];

    $stmt1 = $dbh->prepare('SELECT * FROM person 
                            JOIN client USING (id) 
                            WHERE id = ?');
    $stmt1->execute(array($id));   
    $row = $stmt1->fetch();

    $stmt2 = $dbh->prepare('SELECT * FROM record
                            JOIN appointment ON record.appointment_id=app_id
                            JOIN person ON dentist_id=person.id
                            JOIN servicePerformed ON record.appointment_id=servicePerformed.appointment_id
                            JOIN service ON procedure=procedure_name
                            WHERE record.client_id = ?
                            ORDER BY date, time DESC;');
    $stmt2->execute(array($id));
    $result = $stmt2->fetchAll();
    
    $stmt3 = $dbh->prepare('SELECT * FROM appointment
                            JOIN person ON dentist_id=person.id
                            WHERE client_id = ?
                            ORDER BY date, time ASC;');
    $stmt3->execute(array($id));
    $future = $stmt3->fetchAll();
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
        <img src="images/<?php echo $row['username'] ?>.jpg" alt="<?php echo $row['name'] ?>">
        <div id="info">
            <p> <strong> Name: </strong> <?php echo $row['name'] ?> </p>
            <p> <strong> Address: </strong> <?php echo $row['address'] ?> </p>
            <p> <strong> Phone Number: </strong> <?php echo $row['phone_number'] ?> </p>
            <p> <strong> Birth Date: </strong> <?php echo $row['birth_date'] ?> </p>
            <p> <strong> Tax Number: </strong> <?php echo $row['tax_number'] ?> </p>
            <p> <strong> Insurance: </strong> <?php echo $row['insurance_code'] ?> </p>
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
                            <li> <strong> Dentist Name: </strong> <?php echo $app['name'] ?> </li>  
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
                            <li> <strong> Dentist Name: </strong> <?php echo $app['name'] ?> </li> 
                            <li> <strong> Date: </strong> <?php echo $app['date'] ?> </li> 
                            <li> <strong> Time: </strong> <?php echo $app['time'] ?> </li> 
                            <li> <strong> Specialty: </strong> <?php echo $app['specialty'] ?> </li>
                            <li> <strong> Service Performed: </strong> <?php echo $app['procedure'] ?> </li>
                            <li> 
                                <strong> Final Price: </strong> 
                                <?php 
                                    $stmt = $dbh->prepare('SELECT percentage_discount FROM discount
                                                            WHERE service_name = ? AND insurance_code = ?');
                                    $stmt->execute(array($app['procedure'], $row['insurance_code']));   
                                    $discount = $stmt->fetch();
                                    echo $app['price']-($discount['percentage_discount']*$app['price'])/100;
                                ?> 
                            </li>
                        </ul>
                        <form action="" method="post"> 
                            <p><strong>Observations:</strong></p>
                            <textArea readonly name="observations" rows="5" cols="50" ><?php echo $app['observations']; ?></textArea>
                        </form>
                    </section>
                <?php }
            } ?>
    </section>

    <!-- Footer -->
    <footer>
        <ul class="breadcrumb">
            <li><a href='index.php'>Home</a></li>
            <li><a href='client.php'>Profile</a></li>
            <li>Record</li>
        </ul>
        <p>&copy; Denticare Clinique, 2020</p>
    </footer>

</body>

</html>