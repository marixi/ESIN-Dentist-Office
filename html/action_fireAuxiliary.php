<?php
    
    require_once('database/init_db.php');
    require_once('database/person_db.php');
    require_once('database/dentalAuxiliary_db.php');

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
    header('Location: \manageTeam.php#team_mng');
    
?>