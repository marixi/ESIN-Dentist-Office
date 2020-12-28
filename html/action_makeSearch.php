<?php
    session_start();
    
    if (isset($_POST['clientSearch'])) {
        $_SESSION['clientSearch'] = $_POST['clientSearch'];
    }

    $goBack = $_SERVER['HTTP_REFERER'];
    header("Location: $goBack");
?>