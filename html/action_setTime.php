<?php
    require_once('database/init_db.php');
    require_once('database/dentist_db.php');

    unset($_SESSION['err_msg']);
    unset($_SESSION['dentistUnavailable']);
    $_SESSION['time'] = $_POST['time'];

    if (strlen($_SESSION['time']) == 1) { $time = '0'.$_SESSION['time'].':00'; }
    else { $time = $_SESSION['time'].':00'; }

    $date = $_SESSION['date'];

    $nonAvailable = getUnavailableDentist($date, $time);

    if (count($nonAvailable) == 1) {
        $_SESSION['dentistUnavailable'] = ($nonAvailable['0'])['dentist_id'];
    }

    header('Location: \client.php#bookApp');
?>