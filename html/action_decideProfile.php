<?php
    
    require_once('database/init_db.php');
    require_once('database/dentist_db.php');
    require_once('database/dentalAuxiliary_db.php');
    require_once('database/client_db.php');

    if (isset($_POST['edit']) && $_SESSION['edit_on']==0) {
        $_SESSION['edit_on']=1; 
    }
    
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