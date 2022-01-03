<?php
    if(!isset($_SESSION['user'])) {
        $_SESSION['errors'] = ["You need to be logged in in order to access your cart."];
        header("Location: index.php?p=login");
        exit();
    }
?>
<div class="d-flex min-vh-100 py-5">
    <div class="container mt-5">
        <div class="mt-0 mt-md-3">
            <div class="row flex-column-reverse flex-md-row">
                <div class="col-12 col-md-8 mt-4 mt-md-0">
                    <div class="table-responsive">
                        <table id="cartTable" class="font-small table table-striped table-hover align-middle" cellspacing="0">
                            <thead>
                                <tr>
                                    <td class="colDeviceName text-center">Device name</td>
                                    <td class="colPrice text-center">Price</td>
                                    <td class="colQuantity text-center">Quantity</td>
                                    <td class="colRemove text-center px-3"><i class="fas fa-trash"></i></td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-md-4 mt-2">
                    <form action="models/cart/create-order.php" method="POST" id="checkoutForm">
                        <h3 class="font-medium text-center">Checkout form</h3>
                        <div class="mb-2 mt-2">
                            <label for="tbName" class="font-small">Full name:</label>
                            <input type="text" name="tbName" id="tbName" class="form-control font-small" autocomplete="off"/>
                            <label class="error-message">
                                <ul class="font-small p-0">
                                    <li class="text-danger">- A name cannot have less than 3 characters</li>
                                    <li class="text-danger">- Has to be at least 2 words</li>
                                    <li class="text-danger">- Each word must be capitalized</li>
                                </ul>
                            </label>
                        </div>
                        <div class="mb-2">
                            <label for="tbAddress" class="font-small">Address:</label>
                            <input type="text" name="tbAddress" id="tbAddress" class="form-control font-small" autocomplete="off"/>
                            <label class="error-message font-small text-danger">[Street Name] [Home Number]/[Apartment Number]</label>
                        </div>
                        <label>Total price: <span class="fw-bold"><span id="totalPrice">0</span>&euro;</span></label>
                        <div class="mt-2 mb-3">
                            <input type="submit" value="Checkout" class="font-small btn-primary d-block p-2 w-100 rounded" id="btnCheckout" name="btnCheckout"/>
                        </div>
                        <?php
                            require_once('models/forms/functions.php');
                            displayMessages();
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>