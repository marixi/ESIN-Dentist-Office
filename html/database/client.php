<?php

    function getClientInfo($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM person 
                                JOIN client USING (id) 
                                WHERE id = ?');
        $stmt->execute(array($id));   
        return $stmt->fetch();
    }

?>