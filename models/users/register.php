<?php
    if(isset($_POST['btnRegister'])) {
        session_start();
        require_once("../../config/connection.php");
        require_once("functions.php");

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeatPassword'];

        // regular expressions
        $regExpUsername = "/^[a-zA-Z]\w{4,20}$/";
        $regExpEmail = "/^[a-z][a-z0-9-_\.]{2,}@([a-z0-9-_]{2,}\.)+[a-z]{2,}$/";
        $regExpPassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/";

        // validation
        $errors = [];

        if(!preg_match($regExpUsername, $username)) {
            array_push($errors, "Your username must: start with a letter; be between 5 and 20 characters long; not contain special characters other than '_';");
        }
        if(!preg_match($regExpEmail, $email)) {
            array_push($errors, "Email example: examplename@example.com;");
        }
        if(!preg_match($regExpPassword, $password)) {
            array_push($errors, "Your password must: contain 1 lowercase letter; contain 1 uppercase letter; contain 1 number; contain 1 special character; be 8 characters or longer;");
        }
        if($password != $repeatPassword) {
            array_push($errors, "Passwords don't match;");
        }

        if(count($errors)) {
            $_SESSION['errors'] = $errors;
            http_response_code(400);
        } else {
            if(getUser('email', $email)) {
                array_push($errors, "That email is taken;");
            }
            if(getUser('username', $username)) {
                array_push($errors, "That username is taken;");
            }
            if(count($errors)) {
                $_SESSION['errors'] = $errors;
                http_response_code(400);
            } else {
                if(registerUser($username, $email, $password)) {
                    $_SESSION['messages'] = ["Your account was created successfully."];
                    http_response_code(200);
                } else {
                    $_SESSION['errors'] = ["We encountered an error. Contact the website administrator for more info."];
                    http_response_code(500);
                }
            }
        }
        header('Location: ../../index.php?p=register');
        exit();
    } else {
        http_response_code(400);
    }
?>