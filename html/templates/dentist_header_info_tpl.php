<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <link href="css/profilePage.css" rel="stylesheet">
    <link href="css/dentistAppointments.css" rel="stylesheet">
    <link href="css/managePeople.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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
                <li><a href='dentist.php#Schedule' title="Schedule"> Schedule </a></li>
                <li><a href='dentistAppointments.php' title="Appointments"> Appointments </a></li>
                <li><a href='manageTeam.php#team_mng' title="Manage Team"> Manage Team </a></li>
                <li><a href='action_logout.php' title="Log Out"> Logout </a></li>
            </ul>
        </nav>
    </header>

    <!-- Section to display the information about the dentist -->
    <h1 id="profileTitle"> Dentist </h1>
    <section id="profileInfo">
        <img src="images/<?php echo $dentist['username'] ?>.jpg" alt="Dr.<?php echo $dentist['name'] ?>">
        <div id="info">
            <?php if ($_SESSION['edit_on']==0 && !isset($_POST['edit'])) { ?>

                <form action="action_decideProfile.php" method="post" id="edit_profile">
                 <button type="submit" id="edit_button" name="edit" form="edit_profile"><i class="fa fa-edit"></i></button>
                </form>
                
                <p> <strong> Name: </strong> <?php echo $dentist['name'] ?> </p>
                <p> <strong> Address: </strong> <?php echo $dentist['address'] ?> </p>
                <p> <strong> Phone Number: </strong> <?php echo $dentist['phone_number'] ?> </p>
                <p> <strong> Date of Admission: </strong> <?php echo $dentist['date_of_admission'] ?> </p>

            <?php } else { //$_SESSION['edit_on']=1; ?>
                <form action="action_edit_profile_info.php" method="post">
                    
                    <p> <strong> Name: </p> <input type="text" name="name" value="<?php if(isset($_SESSION['name'])) { echo $_SESSION['name']; } else {echo $dentist['name']; } ?>" required>
                    <p> <strong> Address: </p> <input type="text" name="address" value="<?php if(isset($_SESSION['address'])) { echo $_SESSION['address']; } else {echo $dentist['address']; } ?>" required>
                    <p> <strong> Phone Number: </p> <input type="text" name="phone_number" value="<?php if(isset($_SESSION['phone_number'])) { echo $_SESSION['phone_number']; } else {echo $dentist['phone_number']; } ?>" required>
                    <?php if (isset($_SESSION['error_num_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_num_msg'];;
                                                                                    unset($_SESSION['error_num_msg']) ?> </p> <?php } ?>
                    <p> <strong> Username: </p> <input type="text" name="username" value="<?php if(isset($_SESSION['username'])) { echo $_SESSION['username']; } else {echo $dentist['username']; } ?>" required>
                    <?php if (isset($_SESSION['error_user_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_user_msg'];
                                                                                    unset($_SESSION['error_user_msg']); ?> </p> <?php } ?>
                    <p> <strong> Password: </p> <input type="text" name="password" value="">
                    <p> If you don't want to change the password, leave it blank. </p>
                    <?php if (isset($_SESSION['error_pass_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_pass_msg'];
                                                                                    unset($_SESSION['error_pass_msg']); ?> </p> <?php } ?>


                    <input id="submit" type="submit" value="Submit">
                </form>

            <?php } ?>
        </div>
    </section>

    <?php echo $_SESSION['final_msg']; unset($_SESSION['final_msg']);?>