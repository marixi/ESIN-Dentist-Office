<?php 

    function getAllServices() {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM service ORDER BY specialty_type');
        $stmt->execute();
        return $stmt->fetchAll();
    }

?>