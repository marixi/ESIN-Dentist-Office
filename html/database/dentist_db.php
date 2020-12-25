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

    function getUnavailableDentist($date, $time) {
        $day = substr($date, 8, 2);
        $month = substr($date, 5, 2);
        $year = substr($date, 0, 4);

        global $dbh;
        $stmt = $dbh->prepare('SELECT dentist_id FROM appointment WHERE date = ? AND time = ?');
        $stmt->execute(array($day.'-'.$month.'-'.$year, $time));
        return $stmt->fetchAll();
    }

?>