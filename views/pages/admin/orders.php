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
                <td class="text-center">Buyer username</td>
                <td class="text-center">Buyer name</td>
                <td class="text-center">Buyer address</td>
                <td class="text-center">Total price</td>
                <td class="text-center colActions">Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php
                $orders = getAllOrders();

                foreach($orders as $o):
            ?>
                <tr>
                    <td class="text-center"><?= $o->order_id ?></td>
                    <td class="text-center"><?= $o->username ?></td>
                    <td class="text-center"><?= $o->name ?></td>
                    <td class="text-center"><?= $o->address ?></td>
                    <td class="text-center"><?= $o->total_price ?>&euro;</td>
                    <td class="text-center colActions">
                        <a href="index.php?p=admin&ap=edit-order&id=<?= $o->order_id ?>" class="font-small btn-primary px-2 py-1 rounded">Edit</a>
                        <a href="models/admin/delete.php?id=<?= $o->order_id ?>&ap=<?= $_GET['ap'] ?>" class="font-small btn-primary px-2 py-1 rounded">Delete</a>
                    </td>
                </tr>
            <?php
                endforeach;
            ?>
        </tbody>
    </table>
</div>