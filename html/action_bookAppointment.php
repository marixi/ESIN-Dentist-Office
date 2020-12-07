<?php
    session_start();
    
    $dbh = new PDO('sqlite:sql/dentist_office.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    if (strlen($_SESSION['time']) == 1) { $time = '0'.$_SESSION['time'].':00'; }
    else { $time = $_SESSION['time'].':00'; }

    $day = substr($_SESSION['date'], 8, 2);
    $month = substr($_SESSION['date'], 5, 2);
    $year = substr($_SESSION['date'], 0, 4);
    $date = $day.'-'.$month.'-'.$year;

    $stmt = $dbh->prepare('INSERT INTO appointment (date, time, room, client_id, dentist_id, specialty) VALUES (?, ?, ?, ?, ?, ?)');
    try {
        $stmt->execute(array($date, $time, $_POST['dentist'], $_SESSION['id'], $_POST['dentist'], $_POST['specialty']));
        $_SESSION['msg'] = "Appointment booked successfully!";
    } catch (Exception $e) {
        $_SESSION['msg'] = "Something went wrong! Please try again.";
    }

    unset($_SESSION['date']);
    unset($_SESSION['time']);

    header('Location: \client.php');
?>