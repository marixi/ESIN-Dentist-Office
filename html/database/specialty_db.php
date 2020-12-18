<?php

    function getAllSpecialties() {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM specialty');
        $stmt->execute();
        return $stmt->fetchAll();
    }

?>