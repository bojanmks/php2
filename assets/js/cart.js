$(document).ready(function() {
    // FORM VALIDATION
    // NAME
    let regExpName = /^[A-ZŠĐČĆŽ][a-zšđčćž]{2,}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,})+$/;
    let $tbName = $('#tbName');
    $tbName.blur(checkName);
    function checkName() {
        validateField($tbName, regExpName);
    }

    // ADDRESS
    let regExpAddress = /^[A-ZŠĐČĆŽ][a-zšđčćž]{2,}(\s[A-ZŠĐČĆŽa-zšđčćž][a-zšđčćž]{2,})*\s\d+[A-Z]?(\/\d+)*$/;
    let $tbAddress = $('#tbAddress');
    $tbAddress.blur(checkAddress);
    function checkAddress() {
        validateField($tbAddress, regExpAddress);
    }

    // FORM SUBMITION
    let checkFunctions = [checkName, checkAddress];
    $('#btnCheckout').click(function() {
        return submitForm(checkFunctions);
    });

    // cart table
    getCart();
    function getCart() {
        ajaxCallback('models/cart/get-cart.php', 'GET', function(data) {
            printCart(data);
            printCartQuantity();
        });
    }

    function printCart(data) {
        let totalPrice = 0;
        let html = '';
        for(let el of data) {
            html += `<tr>
            <td class="colDeviceName text-center">${el.name}</td>
            <td class="colPrice text-center">${el.price}&euro;</td>
            <td class="colQuantity d-flex align-items-center justify-content-center"><a href='#' data-id="${el.id}" data-change='decrease' class="btnQuantity btn-primary rounded d-flex align-items-center justify-content-center">-</a><span class='mx-2'>${el.quantity}</span><a href='#' data-id="${el.id}" data-change='increase' class="btnQuantity btn-primary rounded d-flex align-items-center justify-content-center">+</a></td>
            <td class="colRemove text-center"><a href='#' data-id='${el.id}' class='btnRemove'><i class="fas fa-minus text-danger"></i></a></td>
        </tr>`;
            totalPrice += el.quantity * el.price;
        }
        $('#cartTable tbody').html(html);
        $('#totalPrice').html(totalPrice);
        enableQuantityChange();
        enableRemoveItem();
    }

    function enableQuantityChange() {
        $('.btnQuantity').click(function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let change = $(this).data('change');
            changeQuantity(id, change);
        });
    }

    function changeQuantity(id, change) {
        ajaxCallback('models/cart/change-quantity.php', 'POST', function() {
            getCart();
        }, {
            id: id,
            change: change
        });
    }

    function enableRemoveItem() {
        $('.btnRemove').click(function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            removeItem(id);
        });
    }

    function removeItem(id) {
        ajaxCallback('models/cart/remove-item.php', "POST", function() {
            getCart();
        }, {
            id: id
        });
    }
});