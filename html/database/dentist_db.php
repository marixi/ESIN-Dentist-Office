<?php

    function getDentistInfo($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM person 
                            JOIN employee USING (id) 
                            JOIN dentist USING (id) 
                            WHERE id = ?');
        $stmt->execute(array($id));   
        return $stmt->fetch();
    }

    function getDentists() {
        global $dbh;
        $stmt = $dbh->prepare('SELECT id, name FROM person
                                JOIN dentist USING (id)');
        $stmt->execute();   
        return $stmt->fetchAll();
    }


?>