<div class="d-flex min-vh-100 py-5">
    <div class="container mt-5">
        <div class="mt-0 mt-md-3">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <form class="pt-0 pt-md-5">
                                <div class="mb-2 mt-0 mt-md-5">
                                    <label>Brands:</label>
                                    <?php
                                        require_once("models/phones/functions.php");
                                        $brands = getBrands();
                                        foreach($brands as $b):
                                    ?>
                                    <div class="form-check">
                                        <input class="form-check-input chbBrand" type="checkbox" value="<?= $b->id ?>" id="chbBrand<?= $b->id ?>">
                                        <label class="form-check-label" for="chbBrand<?= $b->id ?>">
                                            <?= $b->name ?>
                                        </label>
                                    </div>
                                    <?php
                                        endforeach;
                                    ?>
                                </div>
                                <div class="mb-2">
                                    <label>Operating systems:</label>
                                    <?php
                                        $operatingSystems = getOperatingSystems();
                                        foreach($operatingSystems as $o):
                                    ?>
                                    <div class="form-check">
                                        <input class="form-check-input chbOS" type="checkbox" value="<?= $o->id ?>" id="chbOS<?= $o->id ?>">
                                        <label class="form-check-label" for="chbOS<?= $o->id ?>">
                                            <?= $o->name ?>
                                        </label>
                                    </div>
                                    <?php
                                        endforeach;
                                    ?>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-md-9">
                            <form>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label for="tbMaxPrice" class="font-small">Max. price (&euro;):</label>
                                    <input type="number" name="tbMaxPrice" id="tbMaxPrice" class="form-control font-small" placeholder="Enter max. price"/>
                                </div>
                                <div class="col-12 col-md-5">
                                    <label for="tbSearch" class="font-small">Search products:</label>
                                    <input type="search" name="tbSearch" id="tbSearch" class="form-control font-small" placeholder="Enter product name" autocomplete="off"/>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="ddlSortOrder" class="font-small">Sort order:</label>
                                    <select name="ddlSortOrder" id="ddlSortOrder" class="form-select">
                                        <option value="0">Recommended</option>
                                        <option value="1">Name A-Z</option>
                                        <option value="2">Name Z-A</option>
                                        <option value="3">Price ascending</option>
                                        <option value="4">Price descending</option>
                                    </select>
                                </div>
                            </div>
                            </form>
                                <div id="phones" class="mt-5">
                                    <div class="row">
                                    </div>
                                    <div id="pagination" class="mt-4 d-flex align-items-center justify-content-center">
                                    </div>
                            </div>
                        </div> 
                    </div>
        </div>
    </div>
</div>