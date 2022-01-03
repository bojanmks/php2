$(document).ready(function() {
    // FORM VALIDATION
    // EMAIL
    let regExpEmail = /^[a-z][a-z0-9-_\.]{2,}@([a-z0-9-_]{2,}\.)+[a-z]{2,}$/;
    let $tbEmail = $('#tbEmail');
    $tbEmail.blur(checkEmail);
    function checkEmail() {
        validateField($tbEmail, regExpEmail);
    }

    // PASSWORD
    let regExpPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
    let $tbPassword = $('#tbPassword');
    $tbPassword.blur(checkPassword);
    function checkPassword() {
        validateField($tbPassword, regExpPassword);
    }

    // FORM SUBMITION
    let checkFunctions = [checkEmail, checkPassword];
    $('#btnLogIn').click(function() {
        return submitForm(checkFunctions);
    });
});