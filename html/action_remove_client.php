<?php
    
    require_once('database/init_db.php');
    require_once('database/person_db.php');
    require_once('database/client_db.php');

    $id_to_fire = $_POST['who'];

    try {
        deletePerson($id_to_fire);
    } catch (Exception $e) {
        $_SESSION['msg'] = "Something went wrong! Please try again.";
        header('Location: \manage_clients.php#remove_client');  
    }
    
    try {
        deleteClient($id_to_fire);
    } catch (Exception $e) {
        $_SESSION['msg'] = "Something went wrong! Please try again.";
        header('Location: \manage_clients.php#remove_client');  
    }

    try {
        removeClientAppointments($id_to_fire);
    } catch (Exception $e) {
        $_SESSION['msg'] = "Something went wrong! Please try again.";
        header('Location: \manage_clients.php#remove_client');  
    }

    $_SESSION['final_msg'] = "Client removed successfully!";
    header('Location: \manage_clients.php#client_mng');
    
?>