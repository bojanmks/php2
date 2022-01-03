<?php
    if(isset($_POST['btnSend'])) {
        session_start();
        require_once("../../config/connection.php");
        require_once("functions.php");

        $email = $_POST['email'];
        $name = $_POST['name'];
        $message = $_POST['message'];

        $errors = [];

        // regular expressions
        $regExpName = "/^[A-ZŠĐČĆŽ][a-zšđčćž]{2,}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,})*$/";
        $regExpEmail = "/^[a-z][a-z0-9\-_\.]{2,}@([a-z0-9\-_]{2,}\.)+[a-z]{2,}$/";

        // validation
        if(!preg_match($regExpEmail, $email)) {
            array_push($errors, "Email example: examplename@example.com;");
        }
        if(!preg_match($regExpName, $name)) {
            array_push($errors, "A name cannot have less than 3 characters; Each word of your name must be capitalized;");
        }
        $numberOfSpaces = substr_count($message, ' ');
        if(strlen($message) - $numberOfSpaces < 20 || strlen($message) > 500) {
            array_push($errors, "Your message (without spacing characters) cannot be shorter than 20 characters or longer than 500 characters in total;");
        }

        if(!count($errors)) {
            try {
                if(sendMessage($email, $name, $message)) {
                    $_SESSION['messages'] = ["Your message was sent successfully."];
                    http_response_code(200);
                } else {
                    $_SESSION['errors'] = "We encountered an error. Please try again later.";
                    http_response_code(500);
                }
            } catch (PDOException $ex) {
                $_SESSION['errors'] = ["We encountered an error. Contact the website administrator for more info."];
                updateErrorLog($ex->getMessage());
                http_response_code(500);
            }
        } else {
            $_SESSION['errors'] = $errors;
            http_response_code(400);
        }
        header("Location: ../../index.php?p=contact");
        exit();
    } else {
        http_response_code(400);
    }
?>