<?php
    session_start();

    $dbh = new PDO('sqlite:sql/dentist_office.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $id = $_SESSION['id'];

    $stmt1 = $dbh->prepare('SELECT * FROM person 
                            JOIN employee USING (id) 
                            JOIN dentist USING (id) 
                            WHERE id = ?');
    $stmt1->execute(array($id));   
    $row = $stmt1->fetch();

    $stmt2 = $dbh->prepare('SELECT id, name FROM person 
                            JOIN employee USING (id) 
                            JOIN dentalAuxiliary USING (id)');
    $stmt2->execute();   
    $auxiliaries = $stmt2->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <link href="css/profilePage.css" rel="stylesheet">
    <link href="css/manageTeam.css" rel="stylesheet">
    <title> Dentist </title>

</head>

<body>

    <!-- Header -->
    <header>
        <a href='index.php' title="Home">
            <img src="images/logo.png" alt="Dentist Clinic Logo">
        </a>
        <nav>
            <ul>
                <li><a href='dentist.php' title="Profile"> Profile </a></li>
                <li><a href='/dentist.php#Schedule' title="Schedule"> Schedule </a></li>
                <li><a href='dentistAppointments.php' title="Appointments"> Appointments </a></li>
                <li><a href=#manage title="Manage Team"> Manage Team </a></li>
                <li><a href='action_logout.php' title="Log Out"> Logout </a></li>
            </ul>
        </nav>
    </header>

    <!-- Section to display the information about the dentist -->
    <h1 id="profileTitle"> Dentist </h1>
    <section id="profileInfo">
        <img src="images/<?php echo $row['username'] ?>.jpg" alt="Dr.<?php echo $row['name'] ?>">
        <div id="info">
            <p> <strong> Name: </strong> <?php echo $row['name'] ?> </p>
            <p> <strong> Address: </strong> <?php echo $row['address'] ?> </p>
            <p> <strong> Phone Number: </strong> <?php echo $row['phone_number'] ?> </p>
            <p> <strong> Date of Admission: </strong> <?php echo $row['date_of_admission'] ?> </p>
        </div>
    </section>

    <!-- Section to manage the auxiliaries -->
    <h2> Manage Team </h2>
    <section id="manage">
        <form action="" method="post">
            <label> Want to hire or fire an employee? </label>
            <section id="inputs">
                <input type="submit" value="Hire" name="hire">
                <input type="submit" value="Fire" name="fire">
            </section>
        </form>
        <?php if(isset($_SESSION['final_msg'])) { ?> <p id="final"> <?php echo $_SESSION['final_msg']; unset($_SESSION['final_msg']); ?> </p> <?php } ?>
            <?php if(isset($_POST['hire'])) { ?>
                <br>
                <section id="hire">
                <form action="action_hireAuxiliary.php" method="post">
                    <label> Name: </label>
                    <input type="text" name="name" value="<?php if(isset($_SESSION['name'])) { echo $_SESSION['name']; }?>" required>
                    <br> <label> Address: </label>
                    <input type="text" name="address" value="<?php if(isset($_SESSION['address'])) { echo $_SESSION['address']; }?>" required> </br>
                    <br> <label> Phone Number: </label>
                    <input type="text" name="phone_number" value="<?php if(isset($_SESSION['phone_number'])) { echo $_SESSION['phone_number']; } else { ?> +351********* <?php } ?>" required> </br>
                    <br> <?php if(isset($_SESSION['error_num_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_num_msg']; ; unset($_SESSION['error_num_msg']) ?> </p> <?php } ?>
                    <label> Username: </label>
                    <input type="text" name="username" value="<?php if(isset($_SESSION['username'])) { echo $_SESSION['username']; }?>" required> </br>
                    <br> <?php if(isset($_SESSION['error_user_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_user_msg']; unset($_SESSION['error_user_msg']); ?> </p> <?php } ?>
                    <label> Password: </label>
                    <input type="password" name="password" value="<?php if(isset($_SESSION['password'])) { echo $_SESSION['password']; }?>" required> </br>
                    <?php if(isset($_SESSION['error_pass_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_pass_msg']; unset($_SESSION['error_pass_msg']); ?> </p> <?php } ?>
                    <p> Give random password! The employee may change it in his login page. </p>
                    <br> <label> Salary: </label>
                    <input type="number" name="salary" min="0" max="2000" value="1000" step="100"> </br>
                    <br> <label> Date of Admission: </label>
                    <input type="text" name="date_of_admission" value=<?php echo date('d').'-'.date('m').'-'.date('Y'); ?> > </br>
                    <br> <?php if(isset($_SESSION['msg'])) { ?> <p id="err"> <?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?> </p> <?php } ?>
                    <input id="submit" type="submit" value="Submit"> </br>      
                </form>
            </section>
                </br>
            <?php }
             if(isset($_SESSION['final_msg'])) { ?> <p id="final"> <?php echo $_SESSION['final_msg']; unset($_SESSION['final_msg']); ?> </p> <?php }
             if (isset($_POST['fire'])) { ?>
                <section id="fire">
                <form action="action_fireAuxiliary.php" method="post">
                    <label> Employee: </label>
                    <select name="who" required="required">
                    <?php foreach ($auxiliaries as $auxiliary) { ?>
                        <option value="<?php echo $auxiliary['id']?>"> <?php echo $auxiliary['name']?> </option>
                    <?php } ?>
                    <?php if(isset($_SESSION['msg'])) { ?> <p id="err"> <?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?> </p> <?php } ?>
                    <input id="submit" type="submit" value="Submit">
                </form>
                </section>
                
            <?php }
            ?>
    </section>

    <!-- Footer -->
    <footer>
        <ul class="breadcrumb">
            <li><a href='index.php'>Home</a></li>
            <li><a href='dentist.php'>Profile</a></li>
            <li>Manage Team</li>
        </ul>
        <p>&copy; Denticare Clinique, 2020</p>
    </footer>

</body>

</html>