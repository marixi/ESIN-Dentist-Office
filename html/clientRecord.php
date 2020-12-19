<?php

    require_once('database/init_db.php');
    require_once('database/client_db.php');
    require_once('database/record_db.php');
    require_once('database/appointment_db.php');
    require_once('database/service_db.php');

    if (!isset($_GET['page'])) {
        $_SESSION['page'] = 1;
    } else {
        if ($_GET['page'] < 1) {
            $_SESSION['page'] = 1;
        } else {
            $_SESSION['page'] = $_GET['page'];
        }
    }

    include('templates/profile_header_tpl.php');
    include('templates/profile_info_tpl.php');
    include('templates/future_appointments_tpl.php'); 
    include('templates/past_appointments_tpl.php'); 
    include('templates/pagination_tpl.php');
    include('templates/footer_tpl.php'); 
?>