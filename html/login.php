<?php
session_start();

?>

<!-- Dentist Office -->
<!-- Authors: Duarte Rodrigues, Mariana Xavier -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <title> Login Page </title>
</head>

<body>

    <header id="log">
        <a href='index.php' title="Home"> <img src="images/grey_bg.png" alt="Dentist Clinic Logo" id="logo_img"> </a>
    </header>

    <h1> Denticare Login </h1>

    <form action="action_login.php" method="post">
        <div class="input-field">
            <input type="text" name="username" required="required" value=>
            <label> Username </label>
        </div>
        <div class="input-field">
            <input type="password" name="password" required="required">
            <label> Password </label>
        </div>
        <input type="submit" value="Login">
    </form>
    <p id='login_error'> <?php echo $_SESSION['err_msg'] ?> </p>
    <?php if(isset($_SESSION['err_msg'])) { unset($_SESSION['err_msg']); } ?>
    <!-- Footer -->
    <footer>
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li>Login</li>
        </ul>
        <p>&copy; Denticare Clinique, 2020</p>
    </footer>
</body>

</html>