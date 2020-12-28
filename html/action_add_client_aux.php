<?php 

    session_start();

    if (isset($_GET['not_new'])) {
        $_SESSION['new_client'] = 0;
    } else {
        unset($_SESSION['new_client']);
    }

    $_SESSION['keepOpen'] = 1;
    header('Location: /manage_clients.php#manage');
    
?>