<?php 
    
    require_once('database/init_db.php');
    require_once('database/person_db.php');

    $username = $_POST['username'];
    $password = sha1($_POST['password']);

    $userTry = getPersonUsernameId($username);
    $passTry = getPersonPassword($password, $username);

    if ($userTry) {
        if ($passTry) {
            $_SESSION['id'] = $userTry['id'];
            header('Location: action_decideProfile.php');
        }  
        else {
            $_SESSION['user_try'] = $username;
            $_SESSION['pass_try'] = $password;
            $_SESSION['err_msg'] = 'The password inserted is incorrect!';
            header('Location: login.php');
        }
            
    } else {
        $_SESSION['user_try'] = $username;
        $_SESSION['pass_try'] = $password;
        $_SESSION['err_msg'] = 'The username inserted is incorrect!';
        header('Location: login.php');
    }
        
?>