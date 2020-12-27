<?php 

    require_once('database/init_db.php');
    require_once('database/appointment_db.php');
    require_once('database/auxiliariesAssigned_db.php');

    $id_to_remove = $_POST['delete'];

    try {
        removeAppointment($id_to_remove);
    } catch (Exception $e) {
        $_SESSION['remove_msg'] = "Something went wrong! Please try again.";
        header('Location: \clientRecord.php');
    }

    try {
        removeAuxiliariesAssigned($id_to_remove);
    } catch (Exception $e) {
        $_SESSION['remove_msg'] = "Something went wrong! Please try again.";
        header('Location: \clientRecord.php');
    }

    header('Location: \clientRecord.php');

?>