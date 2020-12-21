<?php
 
    require_once('database/init_db.php');
    require_once('database/record_db.php');

    $observations = $_POST['observations'];
    $id_to_change = $_POST['appointment_to_change'];
    $client_id = $_SESSION['id'];

    updateRecord($observations, $id_to_change, $client_id);

    $go_back=$_SERVER['HTTP_REFERER'];
    header("Location: $go_back#appointment$id_to_change");
    
?>