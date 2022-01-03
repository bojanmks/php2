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

    if(isset($_POST['btnEditOrder'])) {
        require_once('../../../config/connection.php');
        require_once('../functions.php');

        $id = $_POST['id'];
        $name = $_POST['name'];
        $address = $_POST['address'];

        $errors = [];
        $regExpName = "/^[A-Za-z\s]+$/";
        $regExpAddress = "/^[A-ZŠĐČĆŽ][a-zšđčćž]{2,}(\s[A-ZŠĐČĆŽa-zšđčćž][a-zšđčćž]{2,})*\s\d+[A-Z]?(\/\d+)*$/";

        if(!preg_match($regExpName, $name)) {
            array_push($errors, "A name cannot have less than 3 characters; Has to be at least 2 words; Each word must be capitalized");
        }
        if(!preg_match($regExpAddress, $address)) {
            array_push($errors, "Address example: [Street Name] [Home Number]/[Apartment Number];");
        }

        if(count($errors)) {
            http_response_code(400);
            $_SESSION['errors'] = $errors;
        } else {
            if(editOrder($id, $name, $address)) {
                http_response_code(200);
                $_SESSION['messages'] = ["Order was edited successfully."];
            } else {
                http_response_code(500);
                $_SESSION['errors'] = ["We encountered an error."];
            }
        }

        header("Location: ../../../index.php?p=admin&ap=edit-order&id=$id");
    } else {
        http_response_code(400);
    }
?>