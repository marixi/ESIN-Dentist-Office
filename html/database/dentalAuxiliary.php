<?php

    function getAuxiliaryInfo($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM person 
                                JOIN employee USING (id) 
                                JOIN dentalAuxiliary USING (id) 
                                WHERE id = ?');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    function getAllAuxiliaries() {
        global $dbh;
        $stmt = $dbh->prepare('SELECT id, name FROM person 
                                JOIN employee USING (id) 
                                JOIN dentalAuxiliary USING (id)');
        $stmt->execute();   
        return $stmt->fetchAll();
    }

?>