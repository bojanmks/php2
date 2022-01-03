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
<form action="models/admin/phones/add-phone.php" enctype="multipart/form-data" method="POST">
    <div class="mb-2">
        <label for="tbAddPhoneName">Name:</label>
        <input type="text" name="name" id="tbAddPhoneName" class="form-control"/>
        <label class="font-small error-message text-danger">Phone name cannot contain special characters other than '-' and '/'</label>
    </div>
    <div class="mb-2">
        <label for="ddlAddPhoneOS">OS:</label>
        <select name="os" id="ddlAddPhoneOS" class="form-select">
            <?php
                $os = getAllOS();
                foreach($os as $o):
            ?>
            <option value="<?= $o->id ?>"><?= $o->name ?></option>
            <?php
                endforeach;
            ?>
        </select>
    </div>
    <div class="mb-2">
        <label for="ddlAddPhoneBrand">Brand:</label>
        <select name="brand" id="ddlAddPhoneBrand" class="form-select">
            <?php
                $brands = getAllBrands();
                foreach($brands as $b):
            ?>
            <option value="<?= $b->id ?>"><?= $b->name ?></option>
            <?php
                endforeach;
            ?>
        </select>
    </div>
    <div class="mb-2">
        <label for="tbAddPhonePrice">Price:</label>
        <input type="number" name="price" id="tbAddPhonePrice" class="form-control"/>
        <label class="font-small error-message text-danger">You must enter a price</label>
    </div>
    <div class="mb-2">
        <label for="fileAddPhoneImage" class="form-label mb-1">Image:</label>
        <input class="form-control" type="file" id="fileAddPhoneImage" name="image"/>
        <label class="font-small error-message text-danger">You must choose an image</label>
    </div>
    <div class="text-center mb-3">
        <button id="btnAddPhone" name="btnAddPhone" class="py-1 px-3 rounded btn-primary font-small">Add Phone</button>
    </div>
    <?php
        require_once('models/forms/functions.php');
        displayMessages();
    ?>
</form>