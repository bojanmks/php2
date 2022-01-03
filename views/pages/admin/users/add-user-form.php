<?php
    if(isset($_SESSION['user'])) {
        if($_SESSION['user']->role_name != 'admin') {
            http_response_code(404);
            exit();
        }
    } else {
        http_response_code(404);
        exit();
    }
?>
<form action="models/admin/users/add-user.php" method="POST">
    <div class="mb-2">
        <label for="tbAddUserUsername">Username:</label>
        <input type="text" name="username" id="tbAddUserUsername" class="form-control"/>
        <label class="font-small error-message text-danger">Your username must:
            <ul class="p-0">
                <li class="text-danger">- start with a letter</li>
                <li class="text-danger">- be between 5 and 20 characters long</li>
                <li class="text-danger">- not contain special characters other than '_'</li>
            </ul>
        </label>
    </div>
    <div class="mb-2">
        <label for="tbAddUserEmail">Email:</label>
        <input type="email" name="email" id="tbAddUserEmail" class="form-control"/>
        <label class="font-small error-message text-danger">examplename@example.com</label>
    </div>
    <div class="mb-2">
        <label for="tbAddUserPassword">Password:</label>
        <input type="password" name="password" id="tbAddUserPassword" class="form-control"/>
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
    <div class="mb-2">
        <label for="ddlAddUserRole">Role:</label>
        <select name="role" id="ddlAddUserRole" class="form-select">
            <?php
                $roles = getAllRoles();
                foreach($roles as $r):
            ?>
            <option value="<?= $r->role_id ?>"><?= $r->role_name ?></option>
            <?php
                endforeach;
            ?>
        </select>
    </div>
    <div class="text-center mb-3">
        <button id="btnAddUser" name="btnAddUser" class="py-1 px-3 rounded btn-primary font-small">Add User</button>
    </div>
    <?php
        require_once('models/forms/functions.php');
        displayMessages();
    ?>
</form>