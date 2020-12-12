<?php
    
    require_once('database/init.php');

    $id_to_fire = $_POST['who'];

    try {
        $stmt = $dbh->prepare('DELETE FROM person WHERE id = ?');
        $stmt->execute(array($id_to_fire));
    } catch (Exception $e) {
        $_SESSION['msg'] = "Something went wrong! Please try again.";
        header('Location: \manageTeam.php#fire');  
    }

    try {
        $stmt1 = $dbh->prepare('DELETE FROM employee WHERE id = ?');
        $stmt1->execute(array($id_to_fire));
    } catch (Exception $e) {
        $_SESSION['msg'] = "Something went wrong! Please try again.";
        header('Location: \manageTeam.php#fire');  
    }

    try {
        $stmt2 = $dbh->prepare('DELETE FROM dentalAuxiliary WHERE id = ?');
        $stmt2->execute(array($id_to_fire));
    } catch (Exception $e) {
        $_SESSION['msg'] = "Something went wrong! Please try again.";
        header('Location: \manageTeam.php#fire');  
    }

    $_SESSION['final_msg'] = "Employee fired successfully!";
    header('Location: \manageTeam.php#fire');
    
?>