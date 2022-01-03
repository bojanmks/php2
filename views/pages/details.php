<?php
    if(!isset($_GET['id'])) {
        header("Location: index.php?p=phones");
        exit();
    }
    require_once("models/phones/functions.php");
    $phone = getPhoneById($_GET['id']);
    if(!$phone) {
        header("Location: index.php?p=phones");
        exit();
    } else {
        if(!$phone->active) {
            header("Location: index.php?p=phones");
            exit();
        }
    }
?>
<div class="d-flex align-items-center min-vh-100 py-5">
    <div class="container mt-5 mt-md-0">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div id="phoneImage">
                        <img src="assets/img/phones/<?= $phone->image ?>" alt="<?= $phone->name ?>" class="img-fluid"/>
                    </div>
                </div>
                <div class="col-12 col-md-6 d-flex align-items-center align-items-md-start justify-content-center flex-column">
                    <label id="phoneName" class="font-large text-center text-md-start"><?= $phone->name ?></label>
                    <?php
                        $brand = getBrandById($phone->brand);
                        $os = getOSById($phone->os);
                    ?>
                    <div id="phoneBrand">
                        <label class="font-medium"><span class="fw-bold">Brand: </span><?= $brand->name ?></label>
                    </div>
                    <div id="phoneOS">
                        <label class="font-medium"><span class="fw-bold">OS: </span><?= $os->name ?></label>
                    </div>
                    <div id="addToCart" class="mt-3 d-flex justify-content-center justify-content-md-start">
                        <input type="number" name="tbAddToCart" id="tbAddToCart" class="form-control font-small w-25 rounded-0 rounded-start" value="1"/>
                        <a href="#" data-id="<?= $_GET['id'] ?>" id="btnAddToCart" class="text-center btn-primary font-medium py-1 px-4 rounded-end">
                            <i class="fas fa-cart-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
    </div>
</div>