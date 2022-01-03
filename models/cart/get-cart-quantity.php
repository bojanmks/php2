<?php
    session_start();
    $response = 0;
    if(isset($_SESSION['user'])) {
        require_once('../../config/connection.php');
        require_once('functions.php');
        $response = getCartQuantity($_SESSION['user']->id);
    }
    http_response_code(200);
    echo(json_encode($response));
?>