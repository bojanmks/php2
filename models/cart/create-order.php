<?php
    session_start();
    if(isset($_POST['btnCheckout'])) {
        require_once('../../config/connection.php');
        require_once('functions.php');

        $userId = $_SESSION['user']->id;
        $name = $_POST['tbName'];
        $address = $_POST['tbAddress'];

        // regular expressions
        $regExpName = "/^[A-ZŠĐČĆŽ][a-zšđčćž]{2,}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,})+$/";
        $regExpAddress = "/^[A-ZŠĐČĆŽ][a-zšđčćž]{2,}(\s[A-ZŠĐČĆŽa-zšđčćž][a-zšđčćž]{2,})*\s\d+[A-Z]?(\/\d+)*$/";

        // validation
        $errors = [];

        if(!preg_match($regExpName, $name)) {
            array_push($errors, "A name cannot have less than 3 characters; Has to be at least 2 words; Each word must be capitalized;");
        }
        if(!preg_match($regExpAddress, $address)) {
            array_push($errors, "Address example: [Street Name] [Home Number]/[Apartment Number];");
        }

        if(count($errors)) {
            $_SESSION['errors'] = $errors;
            http_response_code(400);
        } else {
            $cart = getCart($userId);
            if(!count($cart)) {
                $_SESSION['errors'] = ['Your cart is empty.'];
                http_response_code(409);
            } else {
                if(createOrder($userId, $name, $address, $cart)) {
                    $_SESSION['messages'] = ['Your order was created successfully.'];
                    http_response_code(200);
                } else {
                    $_SESSION['errors'] = ['We encountered an error.'];
                    http_response_code(500);
                }
            }
        }

        header("Location: ../../index.php?p=cart");
        exit();
    } else {
        http_response_code(400);
    }
?>