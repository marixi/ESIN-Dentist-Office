<?php
    session_start();
    unset($_SESSION['clientSearch']);

    $goBack = $_SERVER['HTTP_REFERER'];
    header("Location: $goBack");
?>