<?php
    
    require_once('database/init_db.php');
    require_once('database/person_db.php');
    require_once('database/client_db.php');
    

    $go_back=$_SERVER['HTTP_REFERER'];

    if ($_FILES['image']['size'] != 0) {
        $fileSize = $_FILES['image']['size'];
        $fileName = $_FILES["image"]["tmp_name"];
        uploadProfileImage($fileSize, $fileName, $_SESSION['id']);
    }
            
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
          
    if (strlen($_POST['password']) != 0) {
        $_SESSION['password'] = $_POST['password'];
        $changes['password'] = $_SESSION['password'];
    }

    $id = $_SESSION['id'];

    $Cspecs = getClientSpecifics($id);

    if($Cspecs){
        $clientChanges = array();

        $_SESSION['birth_date'] = $_POST['birth_date']; //to save the date in the form in case any error occurs

        $day = substr($_POST['birth_date'], 8, 2);
        $month = substr($_POST['birth_date'], 5, 2);
        $year = substr($_POST['birth_date'], 0, 4);
        $_SESSION['birth_date_correct'] = $day.'-'.$month.'-'.$year; //correct way to add to the database
        $clientChanges['birth_date'] = $_SESSION['birth_date_correct'];

        $_SESSION['tax_number'] = $_POST['tax_number'];
        $clientChanges['tax_number'] = $_SESSION['tax_number'];

        if(strlen($_POST['insurance_code'] == 0)){
            $_SESSION['insurance_code'] = NULL;
        }else { 
            $_SESSION['insurance_code'] = $_POST['insurance_code'];
        }

        $clientChanges['insurance_code'] = $_SESSION['insurance_code'];
    }

    $nonUnique = getPersonUsernameId($_SESSION['username']);
   
    if (substr($_SESSION['phone_number'], 0, 1) != '+') {
        $_SESSION['error_num_msg'] = "Please use +351 (for example) in the beginning of the phone number!";
        header("Location: $go_back");
    } else if (strlen($_SESSION['phone_number']) != 13) {
        $_SESSION['error_num_msg'] = "The phone number doesn't exist!";
        header("Location: $go_back");
    } else if (!ctype_digit($testNumber)) {
        $_SESSION['error_num_msg'] = "The phone number is invalid!";
        header("Location: $go_back");
    } else if (ctype_space($_SESSION['username']) == true) {
        $_SESSION['error_user_msg'] = "Invalid username!";
        header("Location: $go_back");
    } else if ($nonUnique && $nonUnique['id'] != $id ) {
        $_SESSION['error_user_msg'] = "That username already exists!";
        header("Location: $go_back");
    } else if (strlen($_SESSION['password']) < 6 && strlen($_SESSION['password']) > 0) {
        $_SESSION['error_pass_msg'] = "The password must be at least 6 characters long!";
        header("Location: $go_back");
    } else if (strpos($_SESSION['password'], '0')===false && strpos($_SESSION['password'], '1')===false &&
                strpos($_SESSION['password'], '2')===false && strpos($_SESSION['password'], '3')===false &&
                strpos($_SESSION['password'], '4')===false && strpos($_SESSION['password'], '5')===false &&
                strpos($_SESSION['password'], '6')===false && strpos($_SESSION['password'], '7')===false &&
                strpos($_SESSION['password'], '8')===false && strpos($_SESSION['password'], '9')===false &&
                strlen($_SESSION['password']) > 0) {
        $_SESSION['error_pass_msg'] = "The password must contain a number!";
        header("Location: $go_back");
    } else if (isset($_SESSION['tax_number']) && !is_numeric($_SESSION['tax_number'])){
        $_SESSION['error_tax_msg'] = "The tax number must contain only numbers!";
        header("Location: $go_back");
    } else if (isset($_SESSION['tax_number']) && strlen($_SESSION['tax_number'])!=9){
        $_SESSION['error_tax_msg'] = "The tax number consists of 9 numbers!";
        header("Location: $go_back");
    } else {
      
        try {
            foreach ($changes as $key => $value){
                updateInfo($key, $value, $id);
            }
            if ($Cspecs) {
                foreach ($clientChanges as $key => $value) {
                    updateClientInfo($key, $value,$id);
                }
            }
        } catch (Exception $e) {
            $_SESSION['msg'] = "Something went wrong! Please try again.";
        }

        if (!isset($_SESSION['error_image']) && !isset($_SESSION['msg'])) {
            $_SESSION['edit_on'] = 0;
            $_SESSION['final_msg'] = "Information changed successfully!";
        }

        unset($_SESSION['name']);
        unset($_SESSION['address']);
        unset($_SESSION['phone_number']);
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        if ($Cspecs) {
            unset($_SESSION['tax_number']);
            unset($_SESSION['birth_date']);
            unset($_SESSION['insurance_code']);
        }

        header("Location: $go_back");
    }
    
?> 