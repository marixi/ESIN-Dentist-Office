<?php
    
    require_once('database/init.php');
    require_once('database/dentist.php');
    require_once('database/dentalAuxiliary.php');
    require_once('database/client.php');

    $id = $_SESSION['id'];

    $row1 = getDentistInfo($id);
    $row2 = getAuxiliaryInfo($id);
    $row3 = getClientInfo($id);
    
    if ($row1) {
        header('Location: dentist.php');
    }
    else if ($row2) {
        header('Location: dentalAuxiliary.php');
    }
    else if ($row3) {
        header('Location: client.php');
    }

?>