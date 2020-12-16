<?php

    function getClients() {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM person 
                                JOIN client USING (id)');
        $stmt->execute();   
        return $stmt->fetchAll();
    }

    function insertIntoClient($id, $date_of_birth, $tax_number, $insurance_code) {
        global $dbh;
        $stmt = $dbh->prepare('INSERT INTO client(id, birth_date, tax_number, insurance_code) VALUES (?, ?, ?, ?)');
        $stmt->execute(array($id, $date_of_birth, $tax_number, $insurance_code));
    }

    function deleteClient($id) {
        global $dbh;
        $stmt = $dbh->prepare('DELETE FROM client WHERE id = ?');
        $stmt->execute(array($id));
    }

    function getClientInfo($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM person 
                                JOIN client USING (id) 
                                WHERE id = ?');
        $stmt->execute(array($id));   
        return $stmt->fetch();
    }

    function getClientSpecifics($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT birth_date, tax_number, insurance_code FROM person 
                                JOIN client USING (id) 
                                WHERE id = ?');
        $stmt->execute(array($id));   
        return $stmt->fetch();
    }

    function updateClientInfo($attribute, $value,$id) {
        global $dbh;
        $stmt = $dbh->prepare("UPDATE client SET $attribute = ? WHERE id = ? ");
        $stmt->execute(array($value,$id));
    }

?>