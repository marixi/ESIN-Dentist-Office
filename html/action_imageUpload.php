<?php

    require_once('database/init_db.php');

    $fileSize = $_FILES['profile_image']['size'];
    $fileName = $_FILES["profile_image"]["tmp_name"];
    
    uploadImage($fileSize, $fileName);

    function uploadImage($fileSize, $fileName) {
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
            if ($width > 2000) {
                $_SESSION["error_image"] = "Image with exceeds the maximum (500 px)";    
            }
            // Attempt to upload file.
            else {
                $uploads_dir = 'images/';
                $name = $_SESSION['id'].'.jpg';
                if (is_uploaded_file($fileName)) {
                    if (!copy($fileName, "$uploads_dir/$name")) {
                        $_SESSION["error_image"] = "Problem uploading: could not move file to destination. Please check again later.";
                    }
                } else {
                    $_SESSION["error_image"] = "Problem uploading: possible file upload attack.";
                }
            } 
        }
    }

    $goBack = $_SERVER['HTTP_REFERER'];
    header("Location: $goBack");
     
?>