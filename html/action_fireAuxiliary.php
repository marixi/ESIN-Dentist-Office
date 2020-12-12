<?php
    
    require_once('database/init.php');
    require_once('database/person.php');

    $id_to_fire = $_POST['who'];

    try {
        deletePerson($id_to_fire);
    } catch (Exception $e) {
        $_SESSION['msg'] = "Something went wrong! Please try again.";
        header('Location: \manageTeam.php#fire');  
    }

    try {
        deleteEmployee($id_to_fire);
    } catch (Exception $e) {
        $_SESSION['msg'] = "Something went wrong! Please try again.";
        header('Location: \manageTeam.php#fire');  
    }

    try {
        deleteDentalAuxiliary($id_to_fire);
    } catch (Exception $e) {
        $_SESSION['msg'] = "Something went wrong! Please try again.";
        header('Location: \manageTeam.php#fire');  
    }

    $_SESSION['final_msg'] = "Employee fired successfully!";
    header('Location: \manageTeam.php#fire');
    
?>