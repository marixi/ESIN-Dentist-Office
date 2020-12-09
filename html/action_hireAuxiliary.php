<?php
    session_start();

    $_SESSION['name'] = $_POST['name'];
    $_SESSION['address'] = $_POST['address'];
    $_SESSION['phone_number'] = $_POST['phone_number'];
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['salary'] = $_POST['salary'];
    $_SESSION['date_of_admission'] = $_POST['date_of_admission'];

    $dbh = new PDO('sqlite:sql/dentist_office.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stmt = $dbh->prepare('SELECT username FROM person WHERE username = ?');
    $stmt->execute(array($_SESSION['username']));
    $nonUnique = $stmt->fetch();

    if (substr($_SESSION['phone_number'], 0, 1) != '+') {
        $_SESSION['error_num_msg'] = "Please use +351 (for example) in the beginning of the phone number!";
        header('Location: \manageTeam.php#hire');    
    } else if (strlen($_SESSION['phone_number']) != 13) {
        $_SESSION['error_num_msg'] = "The phone number doesn't exist!";
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
            $stmt1 = $dbh->prepare('INSERT INTO person (name, address, phone_number, username, password) VALUES (?, ?, ?, ?, ?)');
            $stmt1->execute(array($_SESSION['name'], $_SESSION['address'], $_SESSION['phone_number'], $_SESSION['username'], $_SESSION['password']));
        } catch (Exception $e) {
            $_SESSION['msg'] = "Something went wrong! Please try again.";
            header('Location: \manageTeam.php#hire');  
        }

        $stmt2 = $dbh->prepare('SELECT id FROM person WHERE username = ?');
        $stmt2->execute(array($_SESSION['username']));
        $id = $stmt2->fetch();

        try {
            $stmt3 = $dbh->prepare('INSERT INTO employee (id, salary, date_of_admission) VALUES (?, ?, ?)');
            $stmt3->execute(array($id['id'], $_SESSION['salary'], $_SESSION['date_of_admission']));
        } catch (Exception $e) {
            $_SESSION['msg'] = "Something went wrong! Please try again.";
            header('Location: \manageTeam.php#hire');  
        }

        try {
            $stmt4 = $dbh->prepare('INSERT INTO dentalAuxiliary (id) VALUES (?)');
            $stmt4->execute(array($id['id']));
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