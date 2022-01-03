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
<div class="table-responsive mb-2">
    <table class="font-small table table-striped table-hover align-middle" cellspacing="0">
        <thead>
            <tr>
                <td class="text-center">Name</td>
                <td class="text-center">OS</td>
                <td class="text-center">Brand</td>
                <td class="text-center">Price</td>
                <td class="text-center">Active</td>
                <td class="text-center colActions">Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php
                require_once('models/phones/functions.php');
                $phones = getAllPhones();

                foreach($phones as $p):
            ?>
                <tr>
                    <td class="text-center"><?= $p->phone_name ?></td>
                    <td class="text-center"><?= $p->os_name ?></td>
                    <td class="text-center"><?= $p->brand_name ?></td>
                    <td class="text-center"><?= $p->price ?>&euro;</td>
                    <td class="text-center"><?= $p->active ?></td>
                    <td class="text-center colActions">
                        <a href="index.php?p=admin&ap=edit-phone&id=<?= $p->phone_id ?>" class="font-small btn-primary px-2 py-1 rounded">Edit</a>
                        <a href="models/admin/delete.php?id=<?= $p->phone_id ?>&ap=<?= $_GET['ap'] ?>" class="font-small btn-primary px-2 py-1 rounded">Delete</a>
                    </td>
                </tr>
            <?php
                endforeach;
            ?>
        </tbody>
    </table>
</div>
<a href="index.php?p=admin&ap=add-phone" class="font-small btn-primary px-2 py-1 rounded">Add new phone</a>