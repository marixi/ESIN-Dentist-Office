<?php
    require_once('database/init_db.php');
    require_once('database/service_db.php');

    $services = getAllServices();

    include('templates/main_header_tpl.php');
    include('templates/prices_table_tpl.php'); 
    include('templates/footer_tpl.php'); 

?>