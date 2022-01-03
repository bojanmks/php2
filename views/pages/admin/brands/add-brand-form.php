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
<form action="models/admin/brands/add-brand.php" method="POST">
    <div class="mb-2">
        <label for="tbAddBrandName">Name:</label>
        <input type="text" name="name" id="tbAddBrandName" class="form-control"/>
        <label class="font-small error-message text-danger">Brand name cannot contain special characters or numbers</label>
    </div>
    <div class="text-center mb-3">
        <button id="btnAddBrand" name="btnAddBrand" class="py-1 px-3 rounded btn-primary font-small">Add brand</button>
    </div>
    <?php
        require_once('models/forms/functions.php');
        displayMessages();
    ?>
</form>