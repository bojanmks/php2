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

    if(isset($_POST['btnAddOS'])) {
        require_once('../../../config/connection.php');
        require_once('../functions.php');

        $name = $_POST['name'];

        $errors = [];
        $regExpOSName = "/^[A-Za-z\s]+$/";

        if(!preg_match($regExpOSName, $name)) {
            array_push($errors, "OS name cannot contain special characters or numbers;");
        }

        if(count($errors)) {
            http_response_code(400);
            $_SESSION['errors'] = $errors;
        } else {
            if(getOS('name', $name)) {
                http_response_code(409);
                $_SESSION['errors'] = ["That OS already exists."];
            } else {
                if(addOS($name)) {
                    http_response_code(200);
                    $_SESSION['messages'] = ["OS '$name' was added successfully."];
                } else {
                    http_response_code(500);
                    $_SESSION['errors'] = ["We encountered an error."];
                }
            }
        }

        header("Location: ../../../index.php?p=admin&ap=add-os");
    } else {
        http_response_code(400);
    }
?>