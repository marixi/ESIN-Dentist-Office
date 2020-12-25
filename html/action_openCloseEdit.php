<?php 

    session_start();

    if (isset($_POST['edit']) && $_SESSION['edit_on']==0) {
        $_SESSION['edit_on']=1; 
    } else {
        $_SESSION['edit_on']=0; 
    }

    $go_back=$_SERVER['HTTP_REFERER'];
    header("Location: $go_back");

?>