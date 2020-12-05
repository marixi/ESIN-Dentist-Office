<?php
    session_start();

    $id = $_SESSION['id'];

    $dbh = new PDO('sqlite:sql/dentist_office.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $stmt1 = $dbh->prepare('SELECT * from person JOIN dentist USING (id) WHERE id=?');
    $stmt2 = $dbh->prepare('SELECT * from person JOIN dentalAuxiliary USING (id) WHERE id=?');
    $stmt3 = $dbh->prepare('SELECT * from person JOIN client USING (id) WHERE id=?');

    $stmt1->execute(array($id));
    $stmt2->execute(array($id));
    $stmt3->execute(array($id));

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