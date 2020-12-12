<?php

    function getPersonUsernameId($username) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT username, id FROM person WHERE username = ?');
        $stmt->execute(array($username));
        return $stmt->fetch();
    }

    function getPersonPassword($password, $username) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT password FROM person WHERE password = ? AND username = ?');
        $stmt->execute(array($password, $username));
        return $stmt->fetch();
    }

?>