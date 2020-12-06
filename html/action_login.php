<?php 
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    /* Get the id correspondant to the given username */
    $dbh = new PDO('sqlite:sql/dentist_office.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt1 = $dbh->prepare('SELECT id, username FROM person WHERE username = ? ');
    $stmt1->execute(array($username));

    $stmt2 = $dbh->prepare('SELECT password FROM person WHERE password= ?');
    $stmt2->execute(array($password));

    
    $UserTry = $stmt1->fetch();
    $PassTry = $stmt2->fetch();

    if($UserTry){
        if($PassTry){
            $_SESSION['id'] = $UserTry['id'];
            header('Location: action_decideProfile.php');
        }  
        else{
            $_SESSION['user_try'] = $username;
            $_SESSION['pass_try'] = $password;
            $_SESSION['err_msg'] = 'The password inserted is incorrect!';
            header('Location: login.php');
        }
            
    }else{
        $_SESSION['user_try'] = $username;
        $_SESSION['pass_try'] = $password;
        $_SESSION['err_msg'] = 'The username inserted is incorrect!';
        header('Location: login.php');
    }
        

    
?>