<?php
    session_start();

    $username = $_SESSION['username'];

    $dbh = new PDO('sqlite:sql/dentist_office.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stmt1 = $dbh->prepare('SELECT * from person JOIN dentist USING (id) WHERE username=?');
    $stmt2 = $dbh->prepare('SELECT * from person JOIN dentalAuxiliary USING (id) WHERE username=?');
    $stmt3 = $dbh->prepare('SELECT * from person JOIN client USING (id) WHERE username=?');

    $stmt1->execute(array($username));
    $stmt2->execute(array($username));
    $stmt3->execute(array($username));

    $row1 = $stmt1->fetch();
    $row2 = $stmt2->fetch();
    $row3 = $stmt3->fetch();
    
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