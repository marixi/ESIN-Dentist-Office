<?php
    $dbh = new PDO('sqlite:sql/dentist_office.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $id = $_GET['id'];

    $stmt4 = $dbh->prepare('INSERT INTO record (observations) VALUES (?) WHERE appointment_id=?');