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
    
    $stmt2 = $dbh->prepare('SELECT * FROM auxiliariesAssigned
                            JOIN appointment ON appointment_id=app_id
                            JOIN person ON auxiliary_id=person.id
                            WHERE username = ? AND password = ?');
    $stmt2->execute(array($username, $password));
    $result = $stmt2->fetchAll();
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

    <!-- Section to display the information about the dentist -->
    <h1 id="dentistTitle"> Assistant </h1>
    <section id="dentistInfo">
        <img src="images/<?php echo $row['username'] ?>.jpg" alt="Dr.<?php echo $row['name'] ?>">
        <div id="info">
            <p> <strong> Name: </strong> <?php echo $row['name'] ?> </p>
            <p> <strong> Address: </strong> <?php echo $row['address'] ?> </p>
            <p> <strong> Phone Number: </strong> <?php echo $row['phone_number'] ?> </p>
            <p> <strong> Date of Admission: </strong> <?php echo $row['date_of_admission'] ?> </p>      
        </div>    
    </section>

    <!-- Section regarding the schedule of the dentist -->
    <section id="dentistSchedule">
        <h2> Schedule </h2>
        <label> Select a week: </label>
        <form action="#dentistSchedule" method="post">
            <input type="week" id="week" name="week" min="2020-W1" required="required" value="<?php echo date('Y').'-W'.date('W');?>">
            <input type="submit" value="Update">
        </form>
        <?php
            $dbh = new PDO('sqlite:sql/dentist_office.db');
            $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $week = $_POST['week'];
            $year = intval(substr($week, 0, 4));
            $week = substr($week, 6, 2);

            $monday = new DateTime();
            $monday->setISODate($year, $week, $dayOfWeek = 1);
            $tuesday = new DateTime();
            $tuesday->setISODate($year, $week, $dayOfWeek = 2);
            $wednesday = new DateTime();
            $wednesday->setISODate($year, $week, $dayOfWeek = 3);
            $thursday = new DateTime();
            $thursday->setISODate($year, $week, $dayOfWeek = 4);
            $friday = new DateTime();
            $friday->setISODate($year, $week, $dayOfWeek = 5);
            $saturday = new DateTime();
            $saturday->setISODate($year, $week, $dayOfWeek = 6);

        function find_appointment($day, $hour, $result) {
            foreach ($result as $row) {
                if ($row['date']==$day && $row['time']==$hour) {
                    ?>
                    <a href='dentistAppointment.php?id=<?php echo $row['id']?>#past' title="Appointment" style = "color: black; text-decoration:none;"> #<?php echo $row['app_id']; ?>: </a>
                    <?php echo $row['specialty']; ?>
                    <?php
                }
            }
        }
        ?>
        <h1 id="tableTitle"> Week <?php echo $week ?> </h1>
        <table id="scheduleTable">
            <tr>
                <th> </th>
                <th> Monday <p> <?php if ($monday->format('d-m-Y') != '27-12--0001') {echo $monday->format('d-m-Y');}?> </p> </th>  
                <th> Tuesday <p> <?php if ($tuesday->format('d-m-Y') != '28-12--0001') {echo $tuesday->format('d-m-Y');}?> </p> </th> 
                <th> Wednesday <p> <?php if ($wednesday->format('d-m-Y') != '29-12--0001') {echo $wednesday->format('d-m-Y');}?> </p> </th>
                <th> Thursday <p> <?php if ($thursday->format('d-m-Y') != '30-12--0001') {echo $thursday->format('d-m-Y');}?> </p> </th>    
                <th> Friday <p> <?php if ($friday->format('d-m-Y') != '31-12--0001') {echo $friday->format('d-m-Y');}?> </p> </th>   
                <th> Saturday <p> <?php if ($saturday->format('d-m-Y') != '01-01-0000') {echo $saturday->format('d-m-Y');}?> </p> </th>                        
            </tr>
            <tr>
                <th> 09:00 </th> <?php $hour = '09:00' ?>
                <td><?php find_appointment($monday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($tuesday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($wednesday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($thursday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($friday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($saturday->format('d-m-Y'), $hour, $result) ?></td>
            </tr>
            <tr>
                <th> 10:00 </th> <?php $hour = '10:00' ?>
                <td><?php find_appointment($monday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($tuesday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($wednesday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($thursday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($friday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($saturday->format('d-m-Y'), $hour, $result) ?></td>
            </tr>
            <tr>
                <th> 11:00 </th> <?php $hour = '11:00' ?>
                <td><?php find_appointment($monday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($tuesday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($wednesday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($thursday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($friday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($saturday->format('d-m-Y'), $hour, $result) ?></td>
            </tr>
            <tr>
                <th> 12:00 </th> <?php $hour = '12:00' ?>
                <td><?php find_appointment($monday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($tuesday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($wednesday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($thursday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($friday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($saturday->format('d-m-Y'), $hour, $result) ?></td>
            </tr>
            <tr>
                <th> 13:00 </th> <?php $hour = '13:00' ?>
                <td><?php find_appointment($monday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($tuesday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($wednesday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($thursday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($friday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($saturday->format('d-m-Y'), $hour, $result) ?></td>
            </tr>
            <tr>
                <th> 14:00 </th> <?php $hour = '14:00' ?>
                <td><?php find_appointment($monday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($tuesday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($wednesday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($thursday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($friday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($saturday->format('d-m-Y'), $hour, $result) ?></td>
            </tr>
            <tr>   
                <th> 15:00 </th> <?php $hour = '15:00' ?>
                <td><?php find_appointment($monday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($tuesday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($wednesday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($thursday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($friday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($saturday->format('d-m-Y'), $hour, $result) ?></td>
            </tr>
            <tr>
                <th> 16:00 </th> <?php $hour = '16:00' ?>
                <td><?php find_appointment($monday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($tuesday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($wednesday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($thursday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($friday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($saturday->format('d-m-Y'), $hour, $result) ?></td>
            </tr>
            <tr>
                <th> 17:00 </th> <?php $hour = '17:00' ?>
                <td><?php find_appointment($monday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($tuesday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($wednesday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($thursday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($friday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($saturday->format('d-m-Y'), $hour, $result) ?></td>
            </tr>
            <tr>
                <th> 18:00 </th> <?php $hour = '18:00' ?>
                <td><?php find_appointment($monday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($tuesday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($wednesday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($thursday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($friday->format('d-m-Y'), $hour, $result) ?></td>
                <td><?php find_appointment($saturday->format('d-m-Y'), $hour, $result) ?></td>
            </tr>
        </table>
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
