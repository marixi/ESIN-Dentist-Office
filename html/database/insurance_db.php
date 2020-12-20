<?php

    function getInsuranceCodes() {
        global $dbh;
            $stmt = $dbh->prepare('SELECT * FROM insurance');
            $stmt->execute();   
            return $stmt->fetchAll();
    }

    function getDiscount($procedure, $insurance) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT percentage_discount FROM discount
                                WHERE service_name = ? AND insurance_code = ?');
        $stmt->execute(array($procedure, $insurance));   
        return $stmt->fetch();
    }

?>