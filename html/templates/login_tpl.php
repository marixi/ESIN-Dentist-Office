<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <link href="css/responsive/layout_responsive.css" rel="stylesheet">
    <link href="css/responsive/style_responsive.css" rel="stylesheet">
    <link href="css/responsive/login_responsive.css" rel="stylesheet">
    <title> Login Page </title>
</head>

<body>

    <header id="log">
        <a href='index.php' title="Home"> <img src="images/grey_bg.png" alt="Dentist Clinic Logo" id="logo_img"> </a>
    </header>

    <h1> Denticare Login </h1>

    <form action="action_login.php" method="post">
        <div class="input-field">
            <input type="text" name="username" required="required" value="<?php echo $_SESSION['user_try']; ?>">
            <label> Username </label>
        </div>
        <div class="input-field">
            <input type="password" name="password" required="required">
            <label> Password </label>
        </div>
        <input type="submit" value="Login" id="loginButton">
    </form>
    
    
    <?php if (isset($_SESSION['err_msg'])) { ?>
        <p id='login_error'> <?php echo $_SESSION['err_msg'] ?> </p>
        <?php unset($_SESSION['err_msg']);
        unset($_SESSION['user_try']);
        unset($_SESSION['pass_try']);
        } ?>