<?php 
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    /* Get the id correspondant to the given username */
    $dbh = new PDO('sqlite:sql/dentist_office.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $stmt = $dbh->prepare('SELECT * FROM person WHERE username = ?');
    $stmt->execute(array($username));
    $person = $stmt->fetch();
    $id = $person['id'];
    $_SESSION['id'] = $id;

    header('Location: action_decideProfile.php');
?>