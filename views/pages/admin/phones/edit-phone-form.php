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
    $phone = getPhone('id', $_GET['id']);
?>
<form action="models/admin/phones/edit-phone.php" enctype="multipart/form-data" method="POST">
    <input type="hidden" name="id" value="<?= $phone->id ?>"/>
    <div class="mb-2">
        <label for="tbEditPhoneName">Name:</label>
        <input type="text" name="name" id="tbEditPhoneName" class="form-control" value="<?= $phone->name ?>"/>
        <label class="font-small error-message text-danger">Phone name cannot contain special characters other than '-' and '/'</label>
    </div>
    <div class="mb-2">
        <label for="ddlEditPhoneOS">OS:</label>
        <select name="os" id="ddlEditPhoneOS" class="form-select">
            <?php
                $os = getAllOS();
                foreach($os as $o):
            ?>
            <option <?php if($o->id == $phone->os) echo('selected'); ?> value="<?= $o->id ?>"><?= $o->name ?></option>
            <?php
                endforeach;
            ?>
        </select>
    </div>
    <div class="mb-2">
        <label for="ddlEditPhoneBrand">Brand:</label>
        <select name="brand" id="ddlEditPhoneBrand" class="form-select">
            <?php
                $brands = getAllBrands();
                foreach($brands as $b):
            ?>
            <option <?php if($b->id == $phone->brand) echo('selected'); ?> value="<?= $b->id ?>"><?= $b->name ?></option>
            <?php
                endforeach;
            ?>
        </select>
    </div>
    <div class="mb-2">
        <label for="tbEditPhonePrice">Price:</label>
        <input type="number" name="price" id="tbEditPhonePrice" value="<?= $phone->price ?>" class="form-control"/>
        <label class="font-small error-message text-danger">You must enter a price</label>
    </div>
    <div class="mb-2">
        <label for="fileEditPhoneImage" class="form-label mb-1">Image:</label>
        <input class="form-control mb-1" type="file" id="fileEditPhoneImage" name="image"/>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="chbChangeImage" value="changeImage" id="chbChangeImage">
            <label class="form-check-label" for="chbChangeImage">
                Change image
            </label>
        </div>
        <label class="font-small error-message text-danger">You must choose an image</label>
    </div>
    <div class="mb-2">
        <label for="ddlEditPhoneActive">Active:</label>
        <select name="active" id="ddlEditPhoneActive" class="form-select">
            <?php
                for($i = 0; $i <= 1; $i++):
            ?>
            <option <?php if($i == $phone->active) echo('selected'); ?> value="<?= $i ?>"><?= $i ?></option>
            <?php
                endfor;
            ?>
        </select>
    </div>
    <div class="text-center mb-3">
        <button id="btnEditPhone" name="btnEditPhone" class="py-1 px-3 rounded btn-primary font-small">Edit Phone</button>
    </div>
    <?php
        require_once('models/forms/functions.php');
        displayMessages();
    ?>
</form>