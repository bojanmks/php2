let page = 1;
let phonesPerPage = 6;

$(document).ready(function() {

    $('.chbBrand, .chbOS, #ddlSortOrder').change(function() {
        getPhones(true);
    });
    $('#tbSearch, #tbMaxPrice').on('input', function() {
        getPhones(true);
    });

    getPhones();
    function getPhones(resetPage = false) {
        if(resetPage) page = 1;

        // brands
        let filteredBrands = [];
        for(let el of $('.chbBrand:checked')) {
            filteredBrands.push(el.value);
        }

        // os
        let filteredOS = [];
        for(let el of $('.chbOS:checked')) {
            filteredOS.push(el.value);
        }
        
        // max price
        let maxPrice = $('#tbMaxPrice').val();

        // search
        let search = $('#tbSearch').val();

        // sort order
        let sortOrder = $('#ddlSortOrder').val();

        ajaxCallback('models/phones/get-phones.php', 'GET', function(data) {
            printPhones(data);
        }, {
            brand: filteredBrands,
            os: filteredOS,
            maxPrice: maxPrice,
            search: search,
            order: sortOrder,
            page: page,
            phonesPerPage: phonesPerPage
        });
    }

    function printPhones(data) {
        // phones
        let phones = data.phones;
        let html = '';
        if(phones.length > 0) {
            for(let p of phones) {
                html += `<div class="mx-auto mx-sm-0 col-9 col-sm-6 col-lg-4 text-center mb-3">
                <div class="phoneDiv position-relative rounded">
                <div class="phoneImage">
                    <img src="assets/img/phones/${p.image_small}" alt="${p.name}" class="img-fluid"/>
                </div>
                <label class="phoneName font-medium">${p.name}</label>
                <br/>
                <label class="phonePrice font-medium fw-bold">${p.price}&euro;</label>
                <div class="phoneOverlay position-absolute cover align-items-center justify-content-center">
                    <div class="phoneButtons d-flex flex-column">
                        <a href="index.php?p=details&id=${p.id}" class="btn-white py-1 px-2 rounded mb-2 d-block font-small">Details</a>
                        <a href="#" data-id="${p.id}" class="btn-white btnAddToCart py-1 px-2 rounded d-block font-small"><i class="fas fa-cart-plus"></i></a>
                    </div>
                </div>
                </div>
            </div>`;
            }
        } else {
            html = "<div class='col-12'><p class='text-center text-md-start font-medium'>Oops, seems like there are no phones that match your search criteria.</p></div>";
        }
        $('#phones .row').html(html);
        
        // pagination
        let numberOfPhones = data.numberOfPhones;
        let paginationHtml = '';
        if(numberOfPhones > 0) {
            paginationHtml += `<a href='#' id='btnPrev' class="font-small btn-primary px-3 py-1 rounded-start">&lt;</a>`;
            for(let i = 0; i < numberOfPhones / phonesPerPage; i++) {
                paginationHtml += `<a href='#' data-page='${i + 1}' class="font-small btn-primary px-2 py-1 btnPage">${i + 1}</a>`;
            }
            paginationHtml += `<a href='#' id='btnNext' class="font-small btn-primary px-3 py-1 rounded-end">&gt;</a>`;
        }
        $('#pagination').html(paginationHtml);
        enablePagination();
        enableAddToCart();
    }

    function enablePagination() {
        $('#btnPrev').click(function(e) {
            e.preventDefault();
            if(page > 1) {
                page--;
                getPhones();
            }
        });
    
        $('#btnNext').click(function(e) {
            e.preventDefault();
            if(page < $('.btnPage').length) {
                page++;
                getPhones();
            }
        });

        $('.btnPage').click(function(e) {
            e.preventDefault();
            page = $(this).data('page');
            getPhones();
        });

        for(let el of $('.btnPage')) {
            if($(el).data('page') == page) {
                $(el).addClass('activePage');
                break;
            }
        }
    }

    function enableAddToCart() {
        $('.btnAddToCart').click(function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            addToCart(id);
        });
    }
    
    $('#btnAddToCart').click(function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let quantity = parseInt($('#tbAddToCart').val());
        addToCart(id, quantity);
    });

    function addToCart(phoneId, quantity = 1) {
        let user;
        ajaxCallback('models/users/get-current-user.php', 'GET', function(data) {
            user = data;
            if(user) {
                ajaxCallback('models/cart/add-to-cart.php', 'POST', function(data) {
                    openCartSuccessModal(data);
                    printCartQuantity();
                }, {
                    userId: user.id,
                    phoneId: phoneId,
                    quantity: quantity
                });
            } else {
                location.href = "index.php?p=login";
            }
        }, {
            message: "You need to be logged in in order to add items to your cart."
        });
    }
    
    const modalDuration = 3;
    let timer;
    function openCartSuccessModal(message) {
        if($('.cartSuccessModal').length > 0) {
            $('.cartSuccessModalContent').html(message);
            clearTimeout(timer);
            timer = setModalCloseTimeout(modalDuration);
        } else {
            let html = `<div class="cartSuccessModal w-100 h-100 position-fixed fixed-top pt-5">
            <div class="row mt-5">
                <div class="cartSuccessModalContent mx-auto col-8 col-md-3 alert alert-info text-center">${message}</div>
            </div>
        </div>`;
            $('body').append(html);
            $('.cartSuccessModalContent').fadeIn('fast');
            timer = setModalCloseTimeout(modalDuration);
        }
    }

    function setModalCloseTimeout(duration) {
        return setTimeout(closeCartSuccessModal, duration * 1000);
    }

    function closeCartSuccessModal() {
        $('.cartSuccessModalContent').fadeOut('fast', function() {
            $('.cartSuccessModal').remove();
        });
    }
});