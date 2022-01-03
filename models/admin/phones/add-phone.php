<?php
    session_start();

    if(isset($_SESSION['user'])) {
        if($_SESSION['user']->role_name != 'admin') {
            http_response_code(404);
            exit();
        }
    } else {
        http_response_code(404);
        exit();
    }

    if(isset($_POST['btnAddPhone'])) {
        require_once('../../../config/connection.php');
        require_once('../functions.php');

        $name = $_POST['name'];
        $price = $_POST['price'];
        $os = $_POST['os'];
        $brand = $_POST['brand'];
        $image = $_FILES['image'];

        $errors = [];
        $regExpPhoneName = "/^[A-Za-z0-9\/\-\s]+$/";
        $regExpPrice = "/^[0-9]+(\.[0-9]*)?$/";

        // validation
        if(!preg_match($regExpPhoneName, $name)) {
            array_push($errors, "Phone name cannot contain special characters other than '-' and '/';");
        }
        if(!preg_match($regExpPrice, $price)) {
            array_push($errors, "You must enter a price;");
        } else {
            $price = floatval($price);
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if(!in_array($image['type'], $allowedTypes)) {
            array_push($errors, "Uploaded file must be an image;");
        }

        $allOS = getAllOS();
        $osExists = false;
        foreach($allOS as $o) {
            if($o->id == $os) $osExists = true;
        }
        if(!$osExists) {
            array_push($errors, "That OS doesn't exist;");
        }

        $allBrands = getAllBrands();
        $brandExists = false;
        foreach($allBrands as $b) {
            if($b->id == $brand) $brandExists = true;
        }
        if(!$brandExists) {
            array_push($errors, "That brand doesn't exist;");
        }

        if(getPhone('name', $name)) {
            array_push($errors, "Phone with that name already exists;");
        }
        // validation

        if(count($errors)) {
            http_response_code(400);
            $_SESSION['errors'] = $errors;
        } else {
            // image upload
            // original image
            define('LOCATION', 'assets/img/phones/');
            $originalImageName = time() . '_' . $image['name'];
            $originalImageLocation = LOCATION . $originalImageName;
            $originalImageAbsoluteLocation = ABSOLUTE_PATH . $originalImageLocation;
            // original image
            if(move_uploaded_file($image['tmp_name'], $originalImageAbsoluteLocation)) {
                // small image
                list($width, $height) = getimagesize($originalImageAbsoluteLocation);
                $newWidth = 350;
                $newHeight = $height * ($newWidth / $width);
                $smallImage = imagecreatetruecolor($newWidth, $newHeight);
                $transparent = imagecolorallocatealpha($smallImage, 0, 0, 0, 127);
                imagefill($smallImage, 0, 0, $transparent);
                imagesavealpha($smallImage, true);
                switch($image['type']) {
                    case 'image/jpeg':
                        $originalImage = imagecreatefromjpeg($originalImageAbsoluteLocation);
                        break;
                    case 'image/png':
                        $originalImage = imagecreatefrompng($originalImageAbsoluteLocation);
                        break;
                    case 'image/gif':
                        $originalImage = imagecreatefromgif($originalImageAbsoluteLocation);
                        break;
                }
                imagecopyresampled($smallImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                $smallImageName = "small_" . $originalImageName;
                $smallImageLocation = LOCATION . $smallImageName;
                $smallImageAbsoluteLocation = ABSOLUTE_PATH . $smallImageLocation;
                switch($image['type']) {
                    case 'image/jpeg':
                        $result = imagejpeg($smallImage, $smallImageAbsoluteLocation);
                        break;
                    case 'image/png':
                        $result = imagepng($smallImage, $smallImageAbsoluteLocation);
                        break;
                    case 'image/gif':
                        $result = imagegif($smallImage, $smallImageAbsoluteLocation);
                        break;
                }
                // small image
                // image upload
                if($result) {
                    if(addPhone($name, $price, $os, $brand, $originalImageName, $smallImageName)) {
                        http_response_code(200);
                        $_SESSION['messages'] = ["Phone '$name' was successfully added."];
                    } else {
                        http_response_code(500);
                        $_SESSION['errors'] = ["We encountered an error."];
                    }
                }
            } else {
                http_response_code(500);
                $_SESSION['errors'] = ["We encountered an error."];
            }
        }

        header("Location: ../../../index.php?p=admin&ap=add-phone");
        exit();
    } else {
        http_response_code(400);
    }
?>