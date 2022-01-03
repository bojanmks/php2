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

    $brand = getBrand('id', $_GET['id']);
?>
<form action="models/admin/brands/edit-brand.php" method="POST">
    <input type="hidden" name="id" value="<?= $brand->id ?>"/>
    <div class="mb-2">
        <label for="tbEditBrandName">Name:</label>
        <input type="text" name="name" id="tbEditBrandName" class="form-control" value="<?= $brand->name ?>"/>
        <label class="font-small error-message text-danger">Brand name cannot contain special characters or numbers</label>
    </div>
    <div class="text-center mb-3">
        <button id="btnEditBrand" name="btnEditBrand" class="py-1 px-3 rounded btn-primary font-small">Edit Brand</button>
    </div>
    <?php
        require_once('models/forms/functions.php');
        displayMessages();
    ?>
</form>