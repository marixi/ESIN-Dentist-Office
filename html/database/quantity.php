<?php

    function getAllQuantities() {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM quantity ORDER BY service_name');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getQuantitiesOfService($service) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT material_name, quantity_needed FROM quantity WHERE service_name= ? ');
        $stmt->execute(array($service));
        return $stmt->fetchAll();
    }

?>