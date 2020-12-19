<?php

    require_once('database/init_db.php');
    require_once('database/person_db.php');

    $fileSize = $_FILES['profile_image']['size'];
    $fileName = $_FILES["profile_image"]["tmp_name"];
    
    uploadProfileImage($fileSize, $fileName, $_SESSION['id']);

    $goBack = $_SERVER['HTTP_REFERER'];
    header("Location: $goBack");
     
?>