<?php
    
    require_once('database/init_db.php');
    require_once('database/appointment_db.php');

    if (strlen($_SESSION['time']) == 1) { $time = '0'.$_SESSION['time'].':00'; }
    else { $time = $_SESSION['time'].':00'; }

    $day = substr($_SESSION['date'], 8, 2);
    $month = substr($_SESSION['date'], 5, 2);
    $year = substr($_SESSION['date'], 0, 4);
    $date = $day.'-'.$month.'-'.$year;

    try {
        addNewAppointment($date, $time, $_POST['dentist'], $_SESSION['id'], $_POST['dentist'], $_POST['specialty']);
        $_SESSION['final_msg'] = "Appointment booked successfully!";
    } catch (Exception $e) {
        $_SESSION['msg'] = "Something went wrong! Please try again.";
    }

    unset($_SESSION['date']);
    unset($_SESSION['time']);
    unset($_SESSION['dentistUnavailable']);

    header('Location: /client.php#bookApp');
    
?>