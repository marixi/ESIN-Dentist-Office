<?php
    require_once('database/init_db.php');
    require_once('database/dentist_db.php');

    unset($_SESSION['err_msg']);
    unset($_SESSION['err_client_msg']);
    unset($_SESSION['dentistUnavailable']);
    $_SESSION['time'] = $_POST['time'];

    if (strlen($_SESSION['time']) == 1) { $time = '0'.$_SESSION['time'].':00'; }
    else { $time = $_SESSION['time'].':00'; }

    $date = $_SESSION['date'];
    $day = substr($date, 8, 2);
    $month = substr($date, 5, 2);
    $year = substr($date, 0, 4);

    $stmt = $dbh->prepare('SELECT client_id FROM appointment WHERE date = ? AND time = ?');
    $stmt->execute(array($day.'-'.$month.'-'.$year, $time));
    $clientUnavailable = $stmt->fetch();

    if ($clientUnavailable['client_id'] == $_SESSION['id']) {
        $_SESSION['err_client_msg'] = "You already have an appointment booked for that time and date!";
    } else {
        $nonAvailable = getUnavailableDentist($date, $time);

        if (count($nonAvailable) == 1) {
            $_SESSION['dentistUnavailable'] = ($nonAvailable['0'])['dentist_id'];
        }
    }

    header('Location: \client.php#bookApp');
?>