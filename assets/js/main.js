$(document).ready(function() {
    // SIDENAV
    $('#sidenav, #sidenavContent').hide();

    $('#hamburgerMenu').click(function(e) {
        e.preventDefault();
        openSidenav();
    });

    $('#sidenav').click(function() {
        closeSidenav();
    });

    $('#sidenavContent').click(function(e) {
        e.stopPropagation();
    });

    // TO TOP
    const toTopHeight = 200;
    const toTopFadeDuration = 200;

    if($(window).scrollTop() <= toTopHeight) {
        $('#toTop').hide();
    }

    $('#toTop').click(function(e) {
        e.preventDefault();
        $(window).scrollTop(0);
    });

    $(window).scroll(function() {
        if($(window).scrollTop() > toTopHeight) {
            $('#toTop').fadeIn(toTopFadeDuration);
        } else {
            $('#toTop').fadeOut(toTopFadeDuration);
        }
    });

    // cart quantity
    printCartQuantity();
});

// ajax
function ajaxCallback(url, method, func, data = {}) {
    $.ajax({
        url: url,
        method: method,
        data: data,
        dataType: 'json',
        success: func,
        error: function(xhr) {
            console.error(xhr.responseText);
        }
    });
}

// sidenav
const sidenavAnimationDuration = 200;

function openSidenav() {
    $('#sidenav').fadeIn(sidenavAnimationDuration, function() {
        $('#sidenavContent').animate({width: 'toggle'}, sidenavAnimationDuration);
    });
}

function closeSidenav() {
    $('#sidenavContent').animate({width: 'toggle'}, sidenavAnimationDuration, function() {
        $('#sidenav').fadeOut(sidenavAnimationDuration);
    });
}

// cart quantity
function printCartQuantity() {
    ajaxCallback('models/cart/get-cart-quantity.php', 'GET', function(data) {
        $('#cartQuantity').html(data);
    });
}