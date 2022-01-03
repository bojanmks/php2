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
                <td class="text-center">Name</td>
                <td class="text-center colActions">Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php
                $brands = getAllBrands();

                foreach($brands as $b):
            ?>
                <tr>
                    <td class="text-center"><?= $b->id ?></td>
                    <td class="text-center"><?= $b->name ?></td>
                    <td class="text-center colActions">
                        <a href="index.php?p=admin&ap=edit-brand&id=<?= $b->id ?>" class="font-small btn-primary px-2 py-1 rounded">Edit</a>
                        <a href="models/admin/delete.php?id=<?= $b->id ?>&ap=<?= $_GET['ap'] ?>" class="font-small btn-primary px-2 py-1 rounded">Delete</a>
                    </td>
                </tr>
            <?php
                endforeach;
            ?>
        </tbody>
    </table>
</div>
<a href="index.php?p=admin&ap=add-brand" class="font-small btn-primary px-2 py-1 rounded">Add new brand</a>