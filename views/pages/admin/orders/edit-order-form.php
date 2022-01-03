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

    $order = getOrder('order_id', $_GET['id']);
?>
<form action="models/admin/orders/edit-order.php" method="POST">
    <input type="hidden" name="id" value="<?= $order->order_id ?>"/>
    <div class="mb-2">
        <label for="tbEditOrderName">Name:</label>
        <input type="text" name="name" id="tbEditOrderName" class="form-control" value="<?= $order->name ?>"/>
        <label class="error-message">
            <ul class="font-small p-0">
                <li class="text-danger">- A name cannot have less than 3 characters</li>
                <li class="text-danger">- Has to be at least 2 words</li>
                <li class="text-danger">- Each word must be capitalized</li>
            </ul>
        </label>
    </div>
    <div class="mb-2">
        <label for="tbEditOrderAddress">Address:</label>
        <input type="text" name="address" id="tbEditOrderAddress" class="form-control" value="<?= $order->address ?>"/>
        <label class="font-small error-message text-danger">[Street Name] [Home Number]/[Apartment Number]</label>
    </div>
    <div class="text-center mb-3">
        <button id="btnEditOrder" name="btnEditOrder" class="py-1 px-3 rounded btn-primary font-small">Edit Order</button>
    </div>
    <?php
        require_once('models/forms/functions.php');
        displayMessages();
    ?>
</form>