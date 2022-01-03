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

    if(isset($_POST['btnEditPhone'])) {
        require_once('../../../config/connection.php');
        require_once('../functions.php');

        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $os = $_POST['os'];
        $brand = $_POST['brand'];
        $active = $_POST['active'];
        if(isset($_POST['chbChangeImage'])) {
            $image = $_FILES['image'];
        }

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

        if(isset($_POST['chbChangeImage'])) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if(!in_array($image['type'], $allowedTypes)) {
                array_push($errors, "Uploaded file must be an image;");
            }
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

        $phoneExists = getPhone('name', $name);
        if($phoneExists) {
            if($phoneExists->id != $id) {
                array_push($errors, "Phone with that name already exists;");
            }
        }

        $activeValues = [0, 1];
        if(!in_array($active, $activeValues)) {
            array_push($errors, "Active value can either be 0 or 1;");
        }
        // validation

        if(count($errors)) {
            http_response_code(400);
            $_SESSION['errors'] = $errors;
        } else {
            $continue = true;
            if(isset($_POST['chbChangeImage'])) {
                $continue = false;
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
                    $continue = $result;
                }
            }
            if($continue) {
                if(isset($_POST['chbChangeImage'])) {
                    $result = editPhoneWithImage($id, $name, $price, $os, $brand, $active, $originalImageName, $smallImageName);
                } else {
                    $result = editPhoneWithoutImage($id, $name, $price, $os, $brand, $active);
                }
                if($result) {
                    http_response_code(200);
                    $_SESSION['messages'] = ["Phone was successfully edited."];
                } else {
                    http_response_code(500);
                    $_SESSION['errors'] = ["We encountered an error."];
                }
            } else {
                http_response_code(500);
                $_SESSION['errors'] = ["We encountered an error."];
            }
        }

        header("Location: ../../../index.php?p=admin&ap=edit-phone&id=$id");
        exit();
    } else {
        http_response_code(400);
    }
?>