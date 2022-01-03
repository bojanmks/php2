<?php
    session_start();

    if(isset($_SESSION['user'])) {
        require_once('../../config/connection.php');
        require_once('functions.php');

        $userId = $_SESSION['user']->id;
        $cart = getCart($userId);
        
        http_response_code(200);
        echo(json_encode($cart));
    } else {
        http_response_code(400);
    }
?>