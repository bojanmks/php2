<?php
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        require_once('../../config/connection.php');
        require_once('functions.php');

        $id = $_POST['id'];
        $change = $_POST['change'];

        $changeValues = ['increase', 'decrease'];
        if(!in_array($change, $changeValues)) {
            http_response_code(400);
            exit();
        }

        if(changeQuantity($id, $change)) {
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