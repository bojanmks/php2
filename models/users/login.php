<?php
    if(isset($_POST['btnLogIn'])) {
        session_start();
        require_once("../../config/connection.php");
        require_once("functions.php");

        $email = $_POST['email'];
        $password = $_POST['password'];

        // regular expressions
        $regExpEmail = "/^[a-z][a-z0-9-_\.]{2,}@([a-z0-9-_]{2,}\.)+[a-z]{2,}$/";
        $regExpPassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/";

        // validation
        $errors = [];

        if(!preg_match($regExpEmail, $email)) {
            array_push($errors, "Email example: examplename@example.com;");
        }
        if(!preg_match($regExpPassword, $password)) {
            array_push($errors, "Your password must: contain 1 lowercase letter; contain 1 uppercase letter; contain 1 number; contain 1 special character; be 8 characters or longer;");
        }

        if(count($errors)) {
            $_SESSION['errors'] = $errors;
            http_response_code(400);
        } else {
            $user = getUser('email', $email);
            if(!$user) { // checks if user exists
                $_SESSION['errors'] = ["Invalid credentials."];
                http_response_code(409);
            } else {
                $encPassword = md5($password);
                if($user->password != $encPassword) { // checks if password is correct
                    $_SESSION['errors'] = ["Invalid credentials."];

                    updateLoginLog($user->id, 0);

                    if(getFailedAttempts($user->id, 5) >= 3) {
                        if(lockAccount($user->id)) sendEmail($user);
                    }

                    http_response_code(409);
                } else {
                    if($user->active) { // checks if account is active
                        $_SESSION['user'] = $user;
                        updateLoginLog($user->id, 1);
                        http_response_code(200);
                    } else {
                        $errors = ["Your account is currently locked. Contact the website administrator for more info."];
                        $_SESSION['errors'] = $errors;
                        updateLoginLog($user->id, 0);
                        http_response_code(409);
                    }
                }
            }
        }

        header('Location: ../../index.php?p=login');
        exit();
    } else {
        http_response_code(400);
    }
?>