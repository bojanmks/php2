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

    if(!isset($_GET['id'])) {
        http_response_code(400);
        exit();
    }

    require_once('models/users/functions.php');
    $user = getUser('id', $_GET['id']);
?>
<form action="models/admin/users/edit-user.php" method="POST">
    <input type="hidden" name="id" value="<?= $user->id ?>"/>
    <div class="mb-2">
        <label for="tbEditUserUsername">Username:</label>
        <input type="text" name="username" id="tbEditUserUsername" value="<?= $user->username ?>" class="form-control"/>
        <label class="font-small error-message text-danger">Your username must:
            <ul class="p-0">
                <li class="text-danger">- start with a letter</li>
                <li class="text-danger">- be between 5 and 20 characters long</li>
                <li class="text-danger">- not contain special characters other than '_'</li>
            </ul>
        </label>
    </div>
    <div class="mb-2">
        <label for="tbEditUserEmail">Email:</label>
        <input type="email" name="email" id="tbEditUserEmail" value="<?= $user->email ?>" class="form-control"/>
        <label class="font-small error-message text-danger">examplename@example.com</label>
    </div>
    <div class="mb-2">
        <label for="tbEditUserPassword">Password:</label>
        <input type="password" name="password" id="tbEditUserPassword" class="form-control mb-1"/>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="chbChangePassword" value="changePassword" id="chbChangePassword">
            <label class="form-check-label" for="chbChangePassword">
                Change password
            </label>
        </div>
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
        <label for="ddlEditUserRole">Role:</label>
        <select name="role" id="ddlEditUserRole" class="form-select">
            <?php
                $roles = getAllRoles();
                foreach($roles as $r):
            ?>
            <option <?php if($r->role_id == $user->role) echo('selected'); ?> value="<?= $r->role_id ?>"><?= $r->role_name ?></option>
            <?php
                endforeach;
            ?>
        </select>
    </div>
    <div class="mb-2">
        <label for="ddlEditUserActive">Active:</label>
        <select name="active" id="ddlEditUserActive" class="form-select">
            <?php
                for($i = 0; $i <=1; $i++):
            ?>
            <option <?php if($i == $user->active) echo('selected'); ?> value="<?= $i ?>"><?= $i ?></option>
            <?php
                endfor;
            ?>
        </select>
    </div>
    <div class="text-center mb-3">
        <button id="btnEditUser" name="btnEditUser" class="py-1 px-3 rounded btn-primary font-small">Edit User</button>
    </div>
    <?php
        require_once('models/forms/functions.php');
        displayMessages();
    ?>
</form>