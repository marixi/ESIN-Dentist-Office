<?php
    session_start();

    if (isset($_SESSION['id'])){
        header('Location: action_decideProfile.php');
    }

?>


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
        <?php if (!isset($_SESSION['id'])) { ?>
            <div class="input-field">
                <input type="text" name="username" required="required" value="<?php echo $_SESSION['user_try']; ?>">
                <label> Username </label>
            </div>
            <div class="input-field">
                <input type="password" name="password" required="required" value="<?php echo $_SESSION['pass_try']; ?>">
                <label> Password </label>
            </div>
        <?php } ?>
        <input type="submit" value="Login">
    </form>
    <p id='login_error'> <?php echo $_SESSION['err_msg'] ?> </p>
    <?php if (isset($_SESSION['err_msg'])) {
        unset($_SESSION['err_msg']);
        unset($_SESSION['user_try']);
        unset($_SESSION['pass_try']);
    } ?>

    <?php include('templates/footer_tpl.php'); ?>    