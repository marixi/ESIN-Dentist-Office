<?php

    require_once('database/init_db.php');
    require_once('database/dentist_db.php');
    require_once('database/appointment_db.php');
    require_once('database/record_db.php');
    require_once('database/service_db.php');
    require_once('database/dentalAuxiliary_db.php');
    require_once('database/auxiliariesAssigned_db.php');
    require_once('database/client_db.php');
    include('templates/pagination_tpl.php');

    if (!isset($_GET['past_page'])) {
        $_SESSION['past_page'] = 1;
    } else {
        if ($_GET['past_page'] < 1) {
            $_SESSION['past_page'] = 1;
        } else {
            $_SESSION['past_page'] = $_GET['past_page'];
        }
    }

    if (!isset($_GET['future_page'])) {
        $_SESSION['future_page'] = 1;
    } else {
        if ($_GET['future_page'] < 1) {
            $_SESSION['future_page'] = 1;
        } else {
            $_SESSION['future_page'] = $_GET['future_page'];
        }
    }

    include('templates/profile_header_tpl.php');
    include('templates/profile_info_tpl.php');
    include('templates/search_tpl.php');
    include('templates/future_appointments_tpl.php'); 
    if (!isset($_SESSION['clientSearch'])) {
        addFuturePagination();
    }
    include('templates/to_be_completed_appointments_tpl.php'); 
    include('templates/past_appointments_tpl.php'); 
    if (!isset($_SESSION['clientSearch'])) {
        addPastPagination();
    }
    include('templates/footer_tpl.php'); 

?>    