<?php
    
    require_once('database/init.php');
    require_once('database/person.php');
    require_once('database/dentalAuxiliary.php');

    $_SESSION['name'] = $_POST['name'];
    $_SESSION['address'] = $_POST['address'];
    $_SESSION['phone_number'] = $_POST['phone_number'];
    $testNumber = substr($_SESSION['phone_number'], 1);
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['salary'] = $_POST['salary'];
    $_SESSION['date_of_admission'] = $_POST['date_of_admission'];

    $nonUnique = getPersonUsernameId()

    if (substr($_SESSION['phone_number'], 0, 1) != '+') {
        $_SESSION['error_num_msg'] = "Please use +351 (for example) in the beginning of the phone number!";
        header('Location: \manageTeam.php#hire');    
    } else if (strlen($_SESSION['phone_number']) != 13) {
        $_SESSION['error_num_msg'] = "The phone number doesn't exist!";
        header('Location: \manageTeam.php#hire'); 
    }
    else if (!ctype_digit($testNumber)) {
        $_SESSION['error_num_msg'] = "The phone number is invalid!";
        header('Location: \manageTeam.php#hire'); 
    } else if (strlen($_SESSION['username']) == 0) {
        $_SESSION['error_user_msg'] = "Invalid username!";
        header('Location: \manageTeam.php#hire');
    } else if ($nonUnique) {
        $_SESSION['error_user_msg'] = "That username already exists!";
        header('Location: \manageTeam.php#hire');
    } else if (strlen($_SESSION['password']) < 6) {
        $_SESSION['error_pass_msg'] = "The password must be at least 6 characters long!";
        header('Location: \manageTeam.php#hire');  
    } else if (strpos($_SESSION['password'], '0')==false && strpos($_SESSION['password'], '1')==false &&
                strpos($_SESSION['password'], '2')==false && strpos($_SESSION['password'], '3')==false &&
                strpos($_SESSION['password'], '4')==false && strpos($_SESSION['password'], '5')==false &&
                strpos($_SESSION['password'], '6')==false && strpos($_SESSION['password'], '7')==false &&
                strpos($_SESSION['password'], '8')==false && strpos($_SESSION['password'], '9')==false) {
        $_SESSION['error_pass_msg'] = "The password must contain a number!";
        header('Location: \manageTeam.php#hire');  
    } else {

        try {
            insertIntoPerson($_SESSION['name'], $_SESSION['address'], $_SESSION['phone_number'], $_SESSION['username'], $_SESSION['password']);
        } catch (Exception $e) {
            $_SESSION['msg'] = "Something went wrong! Please try again.";
            header('Location: \manageTeam.php#hire');  
        }

        $id = getPersonId($_SESSION['username'];

        try {
            insertIntoEmployee($id['id'], $_SESSION['salary'], $_SESSION['date_of_admission']);
        } catch (Exception $e) {
            $_SESSION['msg'] = "Something went wrong! Please try again.";
            header('Location: \manageTeam.php#hire');  
        }

        try {
            insertIntoAuxiliary($id['id']);
        } catch (Exception $e) {
            $_SESSION['msg'] = "Something went wrong! Please try again.";
            header('Location: \manageTeam.php#hire');  
        }

        $_SESSION['final_msg'] = "Employee added successfully!";

        unset($_SESSION['name']);
        unset($_SESSION['address']);
        unset($_SESSION['phone_number']);
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_SESSION['salary']);
        unset($_SESSION['date_of_admission']);

        header('Location: \manageTeam.php#hire');
    }
    
?>