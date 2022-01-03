<?php
    if(isset($_SESSION['user'])) {
        header("Location: index.php?p=home");
        exit();
    }
?>
<div class="d-flex align-items-center min-vh-100 py-5">
    <div class="container">
        <div class="row">
            <div id="login-form" class="col-12 col-sm-8 col-md-6 col-lg-4 mx-auto">
                <h3 class="font-large mb-3 text-center">Log in</h3>
                <form action="models/users/login.php" method="POST">
                    <div class="mb-2">
                        <label for="tbEmail">Email:</label>
                        <input type="email" name="email" id="tbEmail" class="form-control"/>
                        <label class="font-small error-message text-danger">examplename@example.com</label>
                    </div>
                    <div class="mb-3">
                        <label for="tbPassword">Password:</label>
                        <input type="password" name="password" id="tbPassword" class="form-control"/>
                        <label class="font-small error-message text-danger">Your password must:
                            <ul class="p-0">
                                <li class="text-danger">- contain 1 lowercase letter</li>
                                <li class="text-danger">- contain 1 uppercase letter</li>
                                <li class="text-danger">- contain 1 number</li>
                                <li class="text-danger">- contain 1 special character</li>
                                <li class="text-danger">- be 8 characters or longer</li>
                            </ul>
                        </label>
                    </div>
                    <div class="text-center mb-3">
                        <button id="btnLogIn" name="btnLogIn" class="py-1 px-3 rounded btn-primary font-small">Log in</button>
                    </div>
                    <?php
                        require_once('models/forms/functions.php');
                        displayMessages();
                    ?>
                </form>
                <a href="index.php?p=register">Don't have an account?<br/>Register instead</a>
            </div>
        </div>
    </div>
</div>