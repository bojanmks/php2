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

    require_once('models/forms/functions.php');
    displayMessages();
?>
<div class="table-responsive">
    <table class="font-small table table-striped table-hover align-middle" cellspacing="0">
        <thead>
            <tr>
                <td class="text-center">ID</td>
                <td class="text-center">Username</td>
                <td class="text-center">Email</td>
                <td class="text-center">Role</td>
                <td class="text-center">Active</td>
                <td class="text-center colActions">Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php
                $users = getAllUsers();

                foreach($users as $u):
            ?>
                <tr>
                    <td class="text-center"><?= $u->id ?></td>
                    <td class="text-center"><?= $u->username ?></td>
                    <td class="text-center"><?= $u->email ?></td>
                    <td class="text-center"><?= $u->role_name ?></td>
                    <td class="text-center"><?= $u->active ?></td>
                    <td class="text-center colActions">
                        <?php
                            if($u->id != $_SESSION['user']->id):
                        ?>
                        <a href="index.php?p=admin&ap=edit-user&id=<?= $u->id ?>" class="font-small btn-primary px-2 py-1 rounded">Edit</a>
                        <a href="models/admin/delete.php?id=<?= $u->id ?>&ap=<?= $_GET['ap'] ?>" class="font-small btn-primary px-2 py-1 rounded">Delete</a>
                        <?php
                            endif;
                        ?>
                    </td>
                </tr>
            <?php
                endforeach;
            ?>
        </tbody>
    </table>
</div>
<a href="index.php?p=admin&ap=add-user" class="font-small btn-primary px-2 py-1 rounded">Add new user</a>
<a href="models/admin/users/export-to-excel.php" class="font-small btn-primary px-2 py-1 rounded">Export to Excel</a>