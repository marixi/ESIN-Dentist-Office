<?php
    
    require_once('database/init.php');
    require_once('database/person.php');
    require_once('database/dentalAuxiliary.php');

    $id=$_SESSION['id'];

    $changes = array();

    $_SESSION['name'] = $_POST['name'];
    $changes['name'] = $_SESSION['name'];

    $_SESSION['address'] = $_POST['address'];
    $changes['address'] = $_SESSION['address'];
    
    $_SESSION['phone_number'] = $_POST['phone_number'];
    $testNumber = substr($_SESSION['phone_number'], 1);
    $changes['phone_number'] = $_SESSION['phone_number'];
    
    $_SESSION['username'] = $_POST['username'];
    $changes['username'] = $_SESSION['username'];
    
    if(strlen($_POST['password'])!=0){
        $_SESSION['password'] = $_POST['password'];
        $changes['password'] = $_SESSION['password'];
    }
    else
        $_SESSION['password'] = NULL;


    $nonUnique = getPersonUsernameId($_SESSION['username']);

    if (substr($_SESSION['phone_number'], 0, 1) != '+') {
        $_SESSION['error_num_msg'] = "Please use +351 (for example) in the beginning of the phone number!";
        header('Location: \dentist.php');    
    } else if (strlen($_SESSION['phone_number']) != 13) {
        $_SESSION['error_num_msg'] = "The phone number doesn't exist!";
        header('Location: \dentist.php'); 
    }
    else if (!ctype_digit($testNumber)) {
        $_SESSION['error_num_msg'] = "The phone number is invalid!";
        header('Location: \dentist.php'); 
    } else if (ctype_space($_SESSION['username']) == true) {
        $_SESSION['error_user_msg'] = "Invalid username!";
        header('Location: \dentist.php');
    } else if ($nonUnique) {
        $_SESSION['error_user_msg'] = "That username already exists!";
        header('Location: \dentist.php');

    } else if (strlen($_SESSION['password']) < 6 && $_SESSION['password']!=NULL) {
        $_SESSION['error_pass_msg'] = "The password must be at least 6 characters long!";
        header('Location: \dentist.php');  
    } else if (strpos($_SESSION['password'], '0')==false && strpos($_SESSION['password'], '1')==false &&
                strpos($_SESSION['password'], '2')==false && strpos($_SESSION['password'], '3')==false &&
                strpos($_SESSION['password'], '4')==false && strpos($_SESSION['password'], '5')==false &&
                strpos($_SESSION['password'], '6')==false && strpos($_SESSION['password'], '7')==false &&
                strpos($_SESSION['password'], '8')==false && strpos($_SESSION['password'], '9')==false && $_SESSION['password']!=NULL) {
        $_SESSION['error_pass_msg'] = "The password must contain a number!";
        header('Location: \dentist.php');  
    } else {
        


        try {
            foreach($changes as $key => $value){
                updateInfo($key, $value,$id);
            }
        } catch (Exception $e) {
            $_SESSION['msg'] = "Something went wrong! Please try again.";
            header('Location: \dentist.php');  
        }

        $_SESSION['final_msg'] = "Information changed successfully!";

        unset($_SESSION['name']);
        unset($_SESSION['address']);
        unset($_SESSION['phone_number']);
        unset($_SESSION['username']);
        unset($_SESSION['password']);

        header('Location: \dentist.php');
    }
    
?>