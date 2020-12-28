<?php
    
    require_once('database/init_db.php');
    require_once('database/person_db.php');
    require_once('database/client_db.php');
    
    $_SESSION['keepOpen'] = 1;

    if (!isset($_SESSION['new_client'])) {
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['address'] = $_POST['address'];
        $_SESSION['phone_number'] = $_POST['phone_number'];
        $testNumber = substr($_SESSION['phone_number'], 1);
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];  
        $nonUnique = getPersonUsernameId($_SESSION['username']);
    }else{$_SESSION['employee'] = $_POST['employee'];}

    $_SESSION['date_of_birth'] = $_POST['date_of_birth']; //to save the date in the form in case any error occurs

    $day = substr($_POST['date_of_birth'], 8, 2);
    $month = substr($_POST['date_of_birth'], 5, 2);
    $year = substr($_POST['date_of_birth'], 0, 4);
    $_SESSION['birth_date'] = $day.'-'.$month.'-'.$year; //correct way to add to the database

    $_SESSION['tax_number'] = $_POST['tax_number'];

    $_SESSION['insurance_code'] = $_POST['insurance_code']; 
    if(strlen($_SESSION['insurance_code']) == 0)
        unset($_SESSION['insurance_code']);

    if (isset($_SESSION['phone_number']) && substr($_SESSION['phone_number'], 0, 1) != '+') {
        $_SESSION['error_num_msg'] = "Please use +351 (for example) in the beginning of the phone number!";
        header('Location: \manage_clients.php#add_client');  
    } else if (isset($_SESSION['phone_number']) && strlen($_SESSION['phone_number']) != 13) {
        $_SESSION['error_num_msg'] = "The phone number doesn't exist!";
        header('Location: \manage_clients.php#add_client'); 
    } else if (isset($_SESSION['username']) && ctype_space($_SESSION['username']) == true) {
        $_SESSION['error_user_msg'] = "Invalid username!";
        header('Location: \manage_clients.php#add_client');
    } else if (isset($_SESSION['phone_number']) && !ctype_digit($testNumber)) {
        $_SESSION['error_num_msg'] = "The phone number is invalid!";
        header('Location: \manage_clients.php#add_client'); 
    } else if (isset($_SESSION['username']) && strlen($_SESSION['username']) == 0) {
        $_SESSION['error_user_msg'] = "Invalid username!";
        header('Location: \manage_clients.php#add_client');
    } else if (isset($_SESSION['username']) && $nonUnique) {
        $_SESSION['error_user_msg'] = "That username already exists!";
        header('Location: \manage_clients.php#add_client');
    } else if (isset($_SESSION['password']) && strlen($_SESSION['password']) < 6) {
        $_SESSION['error_pass_msg'] = "The password must be at least 6 characters long!";
        header('Location: \manage_clients.php#add_client');  
    } else if (isset($_SESSION['password']) && strpos($_SESSION['password'], '0')===false && strpos($_SESSION['password'], '1')===false 
                && strpos($_SESSION['password'], '2')===false && strpos($_SESSION['password'], '3')===false 
                && strpos($_SESSION['password'], '4')===false && strpos($_SESSION['password'], '5')===false 
                && strpos($_SESSION['password'], '6')===false && strpos($_SESSION['password'], '7')===false 
                && strpos($_SESSION['password'], '8')===false && strpos($_SESSION['password'], '9')===false) {
        $_SESSION['error_pass_msg'] = "The password must contain a number!";
        header('Location: \manage_clients.php#add_client');  
    } else if (isset($_SESSION['tax_number']) && strlen($_SESSION['tax_number']) > 0 && !is_numeric($_SESSION['tax_number'])){
        $_SESSION['error_tax_msg'] = "The tax number must only have numbers!";
        header('Location: \manage_clients.php#add_client');
    } else if (isset($_SESSION['tax_number']) && strlen($_SESSION['tax_number']) > 0 && strlen($_SESSION['tax_number'])!=9){
        $_SESSION['error_tax_msg'] = "The tax number must have 9 numbers!";
        header('Location: \manage_clients.php#add_client');
    } else {

        if (!isset($_SESSION['new_client'])) {
            if (checkIfPersonExists($_SESSION['username'])==false) {
                try {
                    insertIntoPerson($_SESSION['name'], $_SESSION['address'], $_SESSION['phone_number'], $_SESSION['username'], sha1($_SESSION['password']));
                } catch (Exception $e) {
                    $_SESSION['msg'] = "Something went wrong! Please try again.";
                    header('Location: \manage_clients.php#add_client');  
                }
            }

            $id = getPersonId($_SESSION['username'])['id'];
        } else {
            $id = $_POST['employee'];
        }

        try {
            insertIntoClient($id, $_SESSION['birth_date'], $_SESSION['tax_number'], $_SESSION['insurance_code']);
        } catch (Exception $e) {
            $_SESSION['msg'] = "Something went wrong! Please try again.";
            header('Location: \manage_clients.php#add_client');  
        }

        $_SESSION['final_msg'] = "Client added successfully!";

        unset($_SESSION['name']);
        unset($_SESSION['address']);
        unset($_SESSION['phone_number']);
        unset($_SESSION['date_of_birth']);
        unset($_SESSION['birth_date']);
        unset($_SESSION['tax_number']);
        unset($_SESSION['insurance_code']);
        unset($_SESSION['username']);
        unset($_SESSION['password']);  
        unset($_SESSION['new_client']);
        unset($_SESSION['keepOpen']);   
        unset($_SESSION['employee']);   

        header('Location: \manage_clients.php#client_mng');
    }
    
?>