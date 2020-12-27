<?php

    function getPersonUsernameId($username) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT username, id FROM person WHERE username = ?');
        $stmt->execute(array($username));
        return $stmt->fetch();
    }

    function getPersonId($username) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT id FROM person WHERE username = ?');
        $stmt->execute(array($username));
        return $stmt->fetch();
    }

    function getPersonInfo($id) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM person WHERE id = ?');
        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    function getPersonPassword($password, $username) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT password FROM person WHERE password = ? AND username = ?');
        $stmt->execute(array($password, $username));
        return $stmt->fetch();
    }

    function deletePerson($id) {
        global $dbh;
        $stmt = $dbh->prepare('DELETE FROM person WHERE id = ?');
        $stmt->execute(array($id));
    }

    function deleteEmployee($id) {
        global $dbh;
        $stmt = $dbh->prepare('DELETE FROM employee WHERE id = ?');
        $stmt->execute(array($id));
    }

    function insertIntoPerson($name, $address, $phone_number, $username, $password) {
        global $dbh;
        $stmt = $dbh->prepare('INSERT INTO person (name, address, phone_number, username, password) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute(array($name, $address, $phone_number, $username, $password));
    }

    function updateInfo($attribute, $value, $id) {
        global $dbh;
        $stmt = $dbh->prepare("UPDATE person SET $attribute = ? WHERE id = ?");
        $stmt->execute(array($value, $id));
    }

    function insertIntoEmployee($id, $salary, $date_of_admission) {
        global $dbh;
        $stmt = $dbh->prepare('INSERT INTO employee (id, salary, date_of_admission) VALUES (?, ?, ?)');
        $stmt->execute(array($id, $salary, $date_of_admission));
    }

    function uploadProfileImage($fileSize, $fileName, $idToUpload) {
        // Check if something was uploaded.
        if ($fileSize == 0) {
            $_SESSION["error_image"] = "Nothing was uploaded.";
        }
        // File size checking.
        else if ($fileSize/1024 > "2048") {
            $_SESSION["error_image"] = "File size should equal or lower than 2 MB.";
        }
        else {
            list($width, $height) = getimagesize($fileName);
            // Check dimensions of image.
            if ($width > 1800) {
                $_SESSION["error_image"] = "Image width exceeds the maximum (1800 px).";    
            }
            // Attempt to upload file.
            else {
                $uploads_dir = 'images/users';
                $name = $idToUpload.'.jpg';
                try {
                    if (file_exists("$uploads_dir/$name")) {
                        copy($fileName, "$uploads_dir/$name");   
                    } else {
                        move_uploaded_file($fileName, "$uploads_dir/$name");  
                    } 
                } catch (Exception $e) {
                    $_SESSION["error_image"] = "Problem uploading: could not move file to destination. Please check again later.";
                }
            } 
        }
    }

    function generateRandomPassword($length) {
        $word = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9, 1));
        shuffle($word);
        return substr(implode($word), 0, $length);
    }

    function checkIfPersonExists($username) {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM person WHERE username = ?');
        $stmt->execute(array($username));
        if ($stmt->fetch()) {
            $exists = true;
        } else {
            $exists = false;
        }
        return $exists;
    } 

    function getAllEmployees() {
        global $dbh;
        $stmt = $dbh->prepare('SELECT * FROM employee JOIN person USING(id)');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getNonClientEmployee() {
        global $dbh;
        
        $employees = getAllEmployees();

        $nonClients = array();
        foreach ($employees as $emp) {
            if (!getClientInfo($emp['id'])) {
                array_push($nonClients, $emp);
            }
        }
        
        return $nonClients;
    }
    
?>