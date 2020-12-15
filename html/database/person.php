<?php

    function getPersonUsernameId($username) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT username, id FROM person WHERE username = ?');
        $stmt->execute(array($username));
        return $stmt->fetch();
    }

    function getPersonId($username) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT id FROM person WHERE username = ?');
        $stmt->execute(array($username));
        return $stmt->fetch();
    }

    function getPersonInfo($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM person WHERE id = ?');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    function getPersonPassword($password, $username) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT password FROM person WHERE password = ? AND username = ?');
        $stmt->execute(array($password, $username));
        return $stmt->fetch();
    }

    function deletePerson($id) {
        global $dbh;
        $stmt = $dbh->prepare('DELETE FROM person WHERE id = ?');
        $stmt->execute(array($id));
    }

    function deleteEmployee($id) {
        global $dbh;
        $stmt = $dbh->prepare('DELETE FROM employee WHERE id = ?');
        $stmt->execute(array($id));
    }

    function insertIntoPerson($name, $address, $phone_number, $username, $password) {
        global $dbh;
        $stmt = $dbh->prepare('INSERT INTO person (name, address, phone_number, username, password) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute(array($name, $address, $phone_number, $username, $password));
    }

    function updatePersonInfo($name, $address, $phone_number, $username, $password) {
        global $dbh;
        $stmt = $dbh->prepare('REPLACE INTO person (name, address, phone_number, username, password) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute(array($name, $address, $phone_number, $username, $password));
    }

    function insertIntoEmployee($id, $salary, $date_of_admission) {
        global $dbh;
        $stmt = $dbh->prepare('INSERT INTO employee (id, salary, date_of_admission) VALUES (?, ?, ?)');
        $stmt->execute(array($id, $salary, $date_of_admission));
    }

    
?>