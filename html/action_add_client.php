<?php
    
    require_once('database/init_db.php');
    require_once('database/person_db.php');
    require_once('database/client_db.php');
    require_once('database/insurance_db.php');
     
    $ins_codes_arr=getInsuranceCodes();
    $ins_codes=array();
    foreach ($ins_codes_arr as $value) {
        array_push($ins_codes,$value['insurance_code']);
    }

    $_SESSION['name'] = $_POST['name'];
    $_SESSION['address'] = $_POST['address'];
    $_SESSION['phone_number'] = $_POST['phone_number'];
    $testNumber = substr($_SESSION['phone_number'], 1);
    $_SESSION['date_of_birth'] = $_POST['date_of_birth'];
    $_SESSION['tax_number'] = $_POST['tax_number'];
    $_SESSION['insurance_code'] = $_POST['insurance_code'];
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];    

    $nonUnique = getPersonUsernameId($_SESSION['username']);

    if (substr($_SESSION['phone_number'], 0, 1) != '+') {
        $_SESSION['error_num_msg'] = "Please use +351 (for example) in the beginning of the phone number!";
        header('Location: \manage_clients.php#add_client');    
    } else if (strlen($_SESSION['phone_number']) != 13) {
        $_SESSION['error_num_msg'] = "The phone number doesn't exist!";
        header('Location: \manage_clients.php#add_client'); 
    } else if (ctype_space($_SESSION['username']) == true) {
        $_SESSION['error_user_msg'] = "Invalid username!";
        header('Location: \manage_clients.php#add_client');
    } else if (!ctype_digit($testNumber)) {
        $_SESSION['error_num_msg'] = "The phone number is invalid!";
        header('Location: \manage_clients.php#add_client'); 
    } else if (strlen($_SESSION['username']) == 0) {
        $_SESSION['error_user_msg'] = "Invalid username!";
        header('Location: \manage_clients.php#add_client');
    } else if ($nonUnique) {
        $_SESSION['error_user_msg'] = "That username already exists!";
        header('Location: \manage_clients.php#add_client');
    } else if (strlen($_SESSION['password']) < 6) {
        $_SESSION['error_pass_msg'] = "The password must be at least 6 characters long!";
        header('Location: \manage_clients.php#add_client');  
    } else if (strpos($_SESSION['password'], '0')===false && strpos($_SESSION['password'], '1')===false &&
                strpos($_SESSION['password'], '2')===false && strpos($_SESSION['password'], '3')===false &&
                strpos($_SESSION['password'], '4')===false && strpos($_SESSION['password'], '5')===false &&
                strpos($_SESSION['password'], '6')===false && strpos($_SESSION['password'], '7')===false &&
                strpos($_SESSION['password'], '8')===false && strpos($_SESSION['password'], '9')===false) {
        $_SESSION['error_pass_msg'] = "The password must contain a number!";
        header('Location: \manage_clients.php#add_client');  
    } else if (strlen($_SESSION['tax_number']) > 0 && !is_numeric($_SESSION['tax_number'])){
        $_SESSION['error_tax_msg'] = "The tax number must only have numbers!";
        header('Location: \manage_clients.php#add_client');
    } else if (strlen($_SESSION['tax_number']) > 0 && strlen($_SESSION['tax_number'])!=9){
        $_SESSION['error_tax_msg'] = "The tax number must have 9 numbers!";
        header('Location: \manage_clients.php#add_client');
    } else if(strlen($_SESSION['insurance_code']) > 0 && !in_array($_SESSION['insurance_code'],$ins_codes)){
        $_SESSION['error_ins_msg'] = "That insurance code is not available for our clinic!";
        header('Location: \manage_clients.php#add_client');
    }else {

        if checkIfPersonExists($_SESSION['username']==false) {
            try {
                insertIntoPerson($_SESSION['name'], $_SESSION['address'], $_SESSION['phone_number'], $_SESSION['username'], sha1($_SESSION['password']));
            } catch (Exception $e) {
                $_SESSION['msg'] = "Something went wrong! Please try again.";
                header('Location: \manage_clients.php#add_client');  
            }
        }

        $id = getPersonId($_SESSION['username']) ;

        try {
            insertIntoClient($id['id'], $_SESSION['date_of_birth'], $_SESSION['tax_number'], $_SESSION['insurance_code']);
        } catch (Exception $e) {
            $_SESSION['msg'] = "Something went wrong! Please try again.";
            header('Location: \manage_clients.php#add_client');  
        }

        $_SESSION['final_msg'] = "Client added successfully!";

        unset($_SESSION['name']);
        unset($_SESSION['address']);
        unset($_SESSION['phone_number']);
        unset($_SESSION['date_of_birth']);
        unset($_SESSION['tax_number']);
        unset($_SESSION['insurance_code']);
        unset($_SESSION['username']);
        unset($_SESSION['password']);        

        header('Location: \manage_clients.php#client_mng');
    }
    
?>