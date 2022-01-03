<?php
    session_start();
    $response = false;
    if(isset($_SESSION['user'])) {
        $response = $_SESSION['user'];
    } else {
        if(isset($_GET['message'])) {
            $_SESSION['errors'] = [$_GET['message']];
        }
    }
    http_response_code(200);
    echo(json_encode($response));
?>