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

    if(isset($_POST['btnAddUser'])) {
        require_once('../../../config/connection.php');
        require_once('../functions.php');

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $errors = [];
        $regExpUsername = "/^[a-zA-Z]\w{4,20}$/";
        $regExpEmail = "/^[a-z][a-z0-9-_\.]{2,}@([a-z0-9-_]{2,}\.)+[a-z]{2,}$/";
        $regExpPassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/";

        // validation
        if(!preg_match($regExpUsername, $username)) {
            array_push($errors, "Your username must: start with a letter; be between 5 and 20 characters long; not contain special characters other than '_';");
        }
        if(!preg_match($regExpEmail, $email)) {
            array_push($errors, "Example email: examplename@example.com;");
        }
        if(!preg_match($regExpPassword, $password)) {
            array_push($errors, "Your password must: contain 1 lowercase letter; contain 1 uppercase letter; contain 1 number; contain 1 special character; be 8 characters or longer;");
        }

        $allRole = getAllRoles();
        $roleExists = false;
        foreach($allRole as $r) {
            if($r->role_id = $role) {
                $roleExists = true;
                break;
            }
        }

        if(!$roleExists) {
            array_push($errors, "That role doesn't exist;");
        }
        // validation

        if(count($errors)) {
            http_response_code(400);
            $_SESSION['errors'] = $errors;
        } else {
            require_once('../../users/functions.php');
            if(getUser('username', $username)) {
                array_push($errors, "That username is taken;");
            }
            if(getUser('email', $email)) {
                array_push($errors, "That email is taken;");
            }
            if(count($errors)) {
                http_response_code(409);
                $_SESSION['errors'] = $errors;
            } else {
                $encPassword = md5($password);
                if(addUser($username, $email, $encPassword, $role)) {
                    http_response_code(200);
                    $_SESSION['messages'] = ["User '$username' was successfully created."];
                } else {
                    http_response_code(500);
                    $_SESSION['errors'] = ["We encountered an error."];
                }
            }
        }

        header("Location: ../../../index.php?p=admin&ap=add-user");
        exit();
    } else {
        http_response_code(400);
    }
?>