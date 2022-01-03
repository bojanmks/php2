$(document).ready(function() {
    $('.error-message').hide();
});

let noErrors;

function validateField(field, regExp) {
    if(field.val().match(regExp)) fieldCorrect(field);
    else fieldIncorrect(field);
}

function fieldCorrect(field) {
    $(field).addClass('border-correct');
    $(field).removeClass('border-danger');
    $(field).siblings('.error-message').slideUp();
}

function fieldIncorrect(field) {
    $(field).addClass('border-danger');
    $(field).removeClass('border-correct');
    $(field).siblings('.error-message').slideDown();
    noErrors = false;
}

function fieldNeutral(field) {
    $(field).removeClass('border-danger');
    $(field).removeClass('border-correct');
    $(field).siblings('.error-message').slideUp();
}

function submitForm(checkFunctions, form = false) {
    noErrors = true;
    for(var f of checkFunctions) {
        f();
    }
    if(noErrors) {
        if(form) clearForm(form);
        return true;
    }
    return false;
}