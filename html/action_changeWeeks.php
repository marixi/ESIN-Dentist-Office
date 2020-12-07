<?php
    session_start();

    $year = intval(substr($_SESSION['choice'], 0, 4));
    $week = substr($_SESSION['choice'], 6, 2);

    $interval = $_POST['interval'];

    if ($interval == '<') { $interval = '-1'; } 
    else if ($interval == '>') { $interval = '+1'; }

    /* First week of the year */
    if ($week == 1 && $interval == -1) {
        $year = $year + $interval;
        $week = date("W",strtotime('28th December '. $year));
        $_SESSION['choice'] = $year . '-W' . $week;
    }
    /* Last week of the year */
    else if ($week == date("W",strtotime('28th December '.$year)) && $interval == +1) {
        $year = $year + $interval;
        $week = 01;
        $_SESSION['choice'] = $year . '-W' . $week;
    }
    /* Any other week */
    else {
        $week = $week + $interval;
        $_SESSION['choice'] = $year . '-W' . $week;
    }

    header('Location: action_decideProfile.php#Schedule');
?>