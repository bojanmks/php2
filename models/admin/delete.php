<?php
    session_start();

    if(isset($_SESSION['user'])) {
        if($_SESSION['user']->role_name != 'admin') {
            http_response_code(404);
            exit();
        }
    } else {
        http_response_code(404);
        exit();
    }

    require_once('../../config/connection.php');
    require_once('functions.php');

    if(isset($_GET['id']) && isset($_GET['ap'])) {
        $id = $_GET['id'];
        $adminPage = $_GET['ap'];
        $result = false;

        switch($adminPage) {
            case 'users':
                $result = deleteUser($id);
                $message = ["User was deleted successfully."];
                break;
            case 'phones':
                $result = deletePhone($id);
                $message = ["Phone was deleted successfully."];
                break;
            case 'brands':
                $result = deleteBrand($id);
                $message = ["Brand was deleted successfully."];
                break;
            case 'operating-systems':
                $result = deleteOS($id);
                $message = ["OS was deleted successfully."];
                break;
            case 'orders':
                $result = deleteOrder($id);
                $message = ["Order was deleted successfully."];
                break;
            case 'messages':
                $result = deleteMessage($id);
                $message = ["Message was deleted successfully."];
                break;
        }

        if($result) {
            http_response_code(200);
            $_SESSION['messages'] = $message;
        } else {
            http_response_code(400);
            $_SESSION['errors'] = ["We encountered an error."];
        }

        header("Location: ../../index.php?p=admin&ap=$adminPage");
        exit();
    } else {
        http_response_code(400);
    }
?>