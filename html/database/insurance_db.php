<?php

    function getInsuranceCodes() {
        global $dbh;
            $stmt = $dbh->prepare('SELECT * FROM insurance');
            $stmt->execute();   
            return $stmt->fetchAll();
    }

?>