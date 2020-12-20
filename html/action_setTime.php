<?php
    require_once('database/init_db.php');

    unset($_SESSION['err_msg']);
    unset($_SESSION['dentistUnavailable']);
    $_SESSION['time'] = $_POST['time'];

    if (strlen($_SESSION['time']) == 1) { $time = '0'.$_SESSION['time'].':00'; }
    else { $time = $_SESSION['time'].':00'; }

    $day = substr($_SESSION['date'], 8, 2);
    $month = substr($_SESSION['date'], 5, 2);
    $year = substr($_SESSION['date'], 0, 4);

    global $dbh;
    $stmt = $dbh->prepare('SELECT dentist_id FROM appointment WHERE date = ? AND time = ?');
    $stmt->execute(array($day.'-'.$month.'-'.$year, $time));
    $nonAvailable = $stmt->fetchAll();

    if (count($nonAvailable) == 1) {
        $_SESSION['dentistUnavailable'] = ($nonAvailable['0'])['dentist_id'];
    }

    header('Location: \client.php#bookApp');
?>