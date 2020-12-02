<!-- Dentist Office -->
<!-- Authors: Duarte Rodrigues, Mariana Xavier -->

<?php
    $dbh = new PDO('sqlite:sql/dentist_office.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $username = $_GET['username'];
    $password = $_GET['password'];

    $stmt1 = $dbh->prepare('SELECT * FROM person JOIN employee USING (id) JOIN dentist USING (id) WHERE username = ? AND password = ?');
    $stmt1->execute(array($username, $password));
    $row = $stmt1->fetch();
    
    $stmt2 = $dbh->prepare('SELECT * FROM appointment JOIN person ON dentist_id=person.id WHERE username = ? AND password = ?');
    $stmt2->execute(array($username, $password));
    $result = $stmt2->fetchAll();
    echo '<pre>';
    print_r($result);
    echo '/<pre>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <link href="css/dentistStyle.css" rel="stylesheet">
    <link href="css/schedule.css" rel="stylesheet">
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
    <h1 id="dentistTitle"> Dentist </h1>
    <section id="dentistInfo">
        <img src="images/<?php echo $row['username'] ?>.png" alt="Dr.<?php echo $row['name'] ?>">
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
        <label for="week">Select a week:</label>
        <br><input type="week" id="week" name="week" min="2020-W1"></br>
        <table>
            <tr>
                <th> </th> <th> Monday </th> <th> Tuesday </th> <th> Wednesday </th> <th> Thursday </th> <th> Friday </th> <th> Saturday </th> 
            </tr>
            <tr>
                <th> 09:00 </th>
            </tr>
            <tr>
                <th> 10:00 </th>
            </tr>
            <tr>
                <th> 11:00 </th>
            </tr>
            <tr>
                <th> 12:00 </th>
            </tr>
            <tr>
                <th> 13:00 </th>
            </tr>
            <tr>
                <th> 14:00 </th>
            </tr>
            <tr>   
                <th> 15:00 </th>
                <td>
                    <?php foreach ($result as $row) {
                        if ($row['date']=='25-12-2020' && $row['time']=='15h00') {
                            echo $row['id'];
                        }
                    } ?>
                </td> 
            </tr>
            <tr>
                <th> 16:00 </th>
                <td>
                    <?php foreach ($result as $row) {
                        if ($row['date']=='28-12-2020' && $row['time']='16h00') {
                            echo $row['id'];
                        }
                    } ?>
                </td> 
            </tr>
            <tr>
                <th> 17:00 </th>
            </tr>
            <tr>
                <th> 18:00 </th>
            </tr>
        </table>
    </schedule>

    <!-- Footer -->
    <footer>
        <ul class="breadcrumb">
            <li>Profile</li>
        </ul>
        <p>&copy; Denticare Clinique, 2020</p>
    </footer>

</body>

</html>