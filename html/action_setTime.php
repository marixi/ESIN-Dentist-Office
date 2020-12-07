<?php
    session_start();

    unset($_SESSION['err_msg']);
    $_SESSION['time'] = $_POST['time'];

    header('Location: \client.php#bookApp');
?>