<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <link href="css/profilePage.css" rel="stylesheet">
    <link href="css/bookAppointment.css" rel="stylesheet">
    <link href="css/dentistAppointments.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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
        <img src="images/<?php echo $client['username'] ?>.jpg" alt="<?php echo $client['name'] ?>" id="client_pic">
        <div id="info">
        <?php if ($_SESSION['edit_on']==0 && !isset($_POST['edit'])) { ?>

<form action="action_decideProfile.php" method="post" id="edit_profile">
 <button type="submit" id="edit_button" name="edit" form="edit_profile"><i class="fa fa-edit"></i></button>
</form>
            <p> <strong> Name: </strong> <?php echo $client['name'] ?> </p>
            <p> <strong> Address: </strong> <?php echo $client['address'] ?> </p>
            <p> <strong> Phone Number: </strong> <?php echo $client['phone_number'] ?> </p>
            <p> <strong> Birth Date: </strong> <?php echo $client['birth_date'] ?> </p>
            <p> <strong> Tax Number: </strong> <?php echo $client['tax_number'] ?> </p>
            <p> <strong> Insurance: </strong> <?php echo $client['insurance_code'] ?> </p>

            <?php } else { //$_SESSION['edit_on']=1; ?>
                <form action="action_edit_profile_info.php" method="post" id='editing'>
                    
                    <p> <strong> Name: </strong>  <input type="text" name="name" value="<?php if(isset($_SESSION['name'])) { echo $_SESSION['name']; } else {echo $client['name']; } ?>" required></p>
                    <p> <strong> Address: </strong>  <input type="text" name="address" value="<?php if(isset($_SESSION['address'])) { echo $_SESSION['address']; } else {echo $client['address']; } ?>" required></p>
                    <p> <strong> Phone Number: </strong>  <input type="text" name="phone_number" value="<?php if(isset($_SESSION['phone_number'])) { echo $_SESSION['phone_number']; } else {echo $client['phone_number']; } ?>" required></p>
                    <?php if (isset($_SESSION['error_num_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_num_msg'];;
                                                                                    unset($_SESSION['error_num_msg']) ?> </p> <?php } ?>
                    <p> <strong> Birth Date: </strong>  <input type="text" name="birth_date" value="<?php if(isset($_SESSION['birth_date'])) { echo $_SESSION['birth_date']; } else {echo $client['birth_date']; } ?>" required></p>
                    <p> <strong> Tax Number: </strong> <input type="text" name="tax_number" value="<?php if(isset($_SESSION['tax_number'])) { echo $_SESSION['tax_number']; } else {echo $client['tax_number']; } ?>"></p> 
                    <?php if (isset($_SESSION['error_tax_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_tax_msg'];
                                                                                    unset($_SESSION['error_tax_msg']); ?> </p> <?php } ?>
                    <p> <strong> Insurance: </strong>  <input type="text" name="insurance_code" value="<?php if(isset($_SESSION['insurance_code'])) { echo $_SESSION['insurance_code']; } else {echo $client['insurance_code']; } ?>"></p>
                    <?php if (isset($_SESSION['error_ins_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_ins_msg'];
                                                                                    unset($_SESSION['error_ins_msg']); ?> </p> <?php } ?>
                    <p> <strong> Username: </strong>  <input type="text" name="username" value="<?php if(isset($_SESSION['username'])) { echo $_SESSION['username']; } else {echo $client['username']; } ?>" required></p>
                    <?php if (isset($_SESSION['error_user_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_user_msg'];
                                                                                    unset($_SESSION['error_user_msg']); ?> </p> <?php } ?>
                    <p> <strong> Password: </strong>  <input type="text" name="password" value=""></p>
                    <p> If you don't want to change the password, leave it blank. </p>
                    <?php if (isset($_SESSION['error_pass_msg'])) { ?> <p id="err"> <?php echo $_SESSION['error_pass_msg'];
                                                                                    unset($_SESSION['error_pass_msg']); ?> </p> <?php } ?>
                    

                    <input id="submit" type="submit" value="Submit">
                </form>

            <?php } ?>
        </div>
    </section>
    <?php echo $_SESSION['final_msg']; unset($_SESSION['final_msg']);?>
    <?php echo $_SESSION['msg']; unset($_SESSION['msg']);?>