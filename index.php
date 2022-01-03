<?php
    session_start();
    require_once('config/connection.php');
    
    require_once('views/fixed/head.php');
    require_once('views/fixed/header.php');

    if(isset($_GET['p'])) {
        switch($_GET['p']) {
            case 'home':
                require_once('views/pages/home.php');
                break;
            case 'phones':
                require_once('views/pages/phones.php');
                break;
            case 'details':
                require_once('views/pages/details.php');
                break;
            case 'contact':
                require_once('views/pages/contact.php');
                break;
            case 'author':
                require_once('views/pages/author.php');
                break;
            case 'cart':
                require_once('views/pages/cart.php');
                break;
            case 'login':
                require_once('views/pages/login.php');
                break;
            case 'register':
                require_once('views/pages/register.php');
                break;
            case 'admin':
                require_once('views/pages/admin.php');
                break;
            default:
                require_once('views/pages/home.php');
        }
    } else {
        require_once('views/pages/home.php');
    }

    require_once('views/fixed/footer.php');
    require_once('views/fixed/scripts.php');
?>