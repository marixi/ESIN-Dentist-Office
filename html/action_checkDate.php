<?php
    session_start();

    $_SESSION['date'] = $_POST['date'];
    unset($_SESSION['err_msg']);
    
    $dayOfWeek = date('l', strtotime($_SESSION['date']));

    if ($dayOfWeek == "Sunday") {
       $_SESSION['err_msg'] = 'We are closed on Sundays! Please choose another day.';
    }

    header('Location: \client.php#bookApp');
?>