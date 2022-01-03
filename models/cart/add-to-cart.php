<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once('../../config/connection.php');
        require_once('functions.php');

        $userId = $_POST['userId'];
        $phoneId = $_POST['phoneId'];
        $quantity = $_POST['quantity'];

        if(addToCart($userId, $phoneId, $quantity)) {
            http_response_code(200);
            echo(json_encode('Item successfully added to cart.'));
        } else {
            http_response_code(500);
            echo(json_encode('We encountered an error.'));
        }
    } else {
        http_response_code(400);
    }
?>