<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        require_once('../../config/connection.php');
        require_once('functions.php');
        $id = $_POST['id'];
        if(removeItem($id)) {
            http_response_code(200);
            echo(json_encode(1));
        } else {
            http_response_code(500);
            echo('We encountered an error.');
        }
    } else {
        http_response_code(400);
    }
?>