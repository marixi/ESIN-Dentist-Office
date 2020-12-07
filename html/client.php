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

    $stmt2 = $dbh->prepare('SELECT type FROM specialty');
    $stmt2->execute();   
    $specialties = $stmt2->fetchAll();

    $stmt3 = $dbh->prepare('SELECT id, name FROM person
                            JOIN dentist USING (id)');
    $stmt3->execute();   
    $dentists = $stmt3->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <link href="css/profilePage.css" rel="stylesheet">
    <link href="css/client.css" rel="stylesheet">
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
                <li><a href=#bookApp title="Schedule"> Book Appointment </a></li>
                <li><a href=#record title="Appointments"> Record </a></li>
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

    <section id="bookApp">
        <h2> Book Appointment </h2>
        <form action="action_checkDate.php" method="post">
            <label> Date: </label>
            <input type="date" name="date" min="<?php echo date('Y').'-'.date('m').'-'.date('d')?>" <?php if(isset($_SESSION['date'])) { ?> value="<?php echo $_SESSION['date']; }?>" required="required">
            <input type="submit" value="Set">
        </form>

        <?php if(isset($_SESSION['msg'])) { ?>
        <p> <?php echo $_SESSION['msg'] ?> </p>
        <?php } else { 

        if(isset($_SESSION['date'])) { ?>
            <form action="action_setTime.php" method="post">
                <?php 
                    if (isset($_SESSION['err_msg'])) { ?>
                        <p> <?php echo $_SESSION['err_msg'] ?> </p>
                    <?php }
                    else { ?>
                        <label> Time: </label>
                        <select name="time" required="required">
                        <?php $dayOfWeek = date('l', strtotime($_SESSION['date']));
                        
                        function checkAvailableHours($date, $time, $value) {
                            $day = substr($_SESSION['date'], 8, 2);
                            $month = substr($_SESSION['date'], 5, 2);
                            $year = substr($_SESSION['date'], 0, 4);

                            global $dbh;
                            $stmt = $dbh->prepare('SELECT date, time, dentist_id FROM appointment WHERE date = ? AND time = ?');
                            $stmt->execute(array($day.'-'.$month.'-'.$year, $time));
                            $nonAvailable = $stmt->fetchAll();

                            if (count($nonAvailable) == 0) {
                                if (isset($_SESSION['time']) && $value == $_SESSION['time']) { ?>
                                    <option value="<?php echo $value ?>" selected="selected"> <?php echo $time ?> </option>
                                <?php } else { ?>
                                    <option value="<?php echo $value ?>"> <?php echo $time ?> </option>    
                                <?php }
                            }
                            else if (count($nonAvailable) == 1) {
                                $_SESSION['dentistUnavailable'] = ($nonAvailable['0'])['dentist_id'];
                                if (isset($_SESSION['time']) && $value == $_SESSION['time']) { ?>
                                    <option value="<?php echo $value ?>" selected="selected"> <?php echo $time ?> </option>
                                <?php } else { ?>
                                    <option value="<?php echo $value ?>"> <?php echo $time ?> </option>    
                                <?php }
                            }
                        }

                        $arrayWeek = array('09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00');
                        $arrayWeekend = array('09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00');

                        switch($dayOfWeek) {
                            case "Monday": case "Tuesday": case "Wednesday": case "Thursday": case "Friday":
                                $value = 9;
                                foreach ($arrayWeek as $hour) {
                                    checkAvailableHours($_SESSION['date'], $hour, $value);
                                    $value = $value+1;
                                }
                                break;
                            case "Saturday":
                                $value = 9;
                                foreach ($arrayWeekend as $hour) {
                                    checkAvailableHours($_SESSION['date'], $hour, $value);
                                    $value = $value+1;
                                }
                                break;
                        } ?>
                        </select>
                        <input type="submit" value="Set">
                    <?php }
                ?>
            </form>
        <?php }

        if (isset($_SESSION['time'])) { ?>
            <form action="action_bookAppointment.php" method="post">
                <label> Specialty: </label>
                <select name="specialty" required="required">
                <?php foreach ($specialties as $specialty) { ?>
                    <option value="<?php echo $specialty['type']?>"> <?php echo $specialty['type']?> </input>
                <?php } ?>
                </select>
                <label> Dentist: </label>
                <?php foreach ($dentists as $dentist) {
                    if (isset($_SESSION['dentistUnavailable']) && $dentist['id'] != $_SESSION['dentistUnavailable']) { ?>
                            <input type="radio" name="dentist" value="<?php echo $dentist['id']?>" required="required"> Dr. <?php echo $dentist['name']?> </input>
                        <?php }
                    else if (!isset($_SESSION['dentistUnavailable'])) { ?>
                        <input type="radio" name="dentist" value="<?php echo $dentist['id']?>" required="required"> Dr. <?php echo $dentist['name']?> </input>
                    <?php }
                } ?>
                <input type="submit" value="Submit">
            </form>
        <?php }
        } ?>     
    </section>
    <?php 
        unset($_SESSION['msg']); 
    ?> 

    <!-- Footer -->
    <footer>
        <ul class="breadcrumb">
            <li><a href='index.php'>Home</a></li>
            <li><a href='client.php'>Profile</a></li>
            <li>Book Appointment</li>
        </ul>
        <p>&copy; Denticare Clinique, 2020</p>
    </footer>

</body>

</html>