    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
    <?php
        if(isset($_GET['p'])) {
            switch($_GET['p']) {
                case 'phones':
                    echo("<script src='assets/js/phones.min.js'></script>");
                    break;
                case 'details':
                    echo("<script src='assets/js/phones.min.js'></script>");
                    break;
                case 'contact':
                    echo("<script src='assets/js/form-validation.min.js'></script>");
                    echo("<script src='assets/js/contact.min.js'></script>");
                    break;
                case 'cart':
                    echo("<script src='assets/js/form-validation.min.js'></script>");
                    echo("<script src='assets/js/cart.min.js'></script>");
                    break;
                case 'login':
                    echo("<script src='assets/js/form-validation.min.js'></script>");
                    echo("<script src='assets/js/login.min.js'></script>");
                    break;
                case 'register':
                    echo("<script src='assets/js/form-validation.min.js'></script>");
                    echo("<script src='assets/js/register.min.js'></script>");
                    break;
                case 'admin':
                    echo("<script src='assets/js/form-validation.min.js'></script>");
                    echo("<script src='assets/js/admin.min.js'></script>");
                    break;
            }
        }
    ?>
</body>
</html>