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

    if(isset($_POST['btnEditBrand'])) {
        require_once('../../../config/connection.php');
        require_once('../functions.php');

        $id = $_POST['id'];
        $name = $_POST['name'];

        $errors = [];
        $regExpBrandName = "/^[A-Za-z\s]+$/";

        if(!preg_match($regExpBrandName, $name)) {
            array_push($errors, "Brand name cannot contain special characters or numbers;");
        }

        if(count($errors)) {
            http_response_code(400);
            $_SESSION['errors'] = $errors;
        } else {
            $exists = false;
            $brandExists = getBrand('name', $name);
            if($brandExists) {
                if($brandExists->id != $id) $exists = true;
            }
            if($exists) {
                http_response_code(409);
                $_SESSION['errors'] = ['That brand already exists.'];
            } else {
                if(editBrand($id, $name)) {
                    http_response_code(200);
                    $_SESSION['messages'] = ["Brand was edited successfully."];
                } else {
                    http_response_code(500);
                    $_SESSION['errors'] = ["We encountered an error."];
                }
            }
        }

        header("Location: ../../../index.php?p=admin&ap=edit-brand&id=$id");
    } else {
        http_response_code(400);
    }
?>