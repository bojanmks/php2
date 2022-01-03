$(document).ready(function() {
    // FORM VALIDATION
    // USERNAME
    let regExpUsername = /^[a-zA-Z]\w{4,20}$/;
    let $tbUsername = $('#tbUsername');
    $tbUsername.blur(checkUsername);
    function checkUsername() {
        validateField($tbUsername, regExpUsername);
    }

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
    $tbPassword.blur(function() {
        checkPassword();
        if($($tbRepeatPassword).val() != '') {
            checkRepeatPassword();
        }
    });
    function checkPassword() {
        validateField($tbPassword, regExpPassword);
    }

    //REPEAT PASSWORD
    let $tbRepeatPassword = $('#tbRepeatPassword');
    $tbRepeatPassword.blur(checkRepeatPassword);
    function checkRepeatPassword() {
        if($($tbPassword).hasClass('border-correct') && $($tbRepeatPassword).val() == $($tbPassword).val()) {
            fieldCorrect($tbRepeatPassword);
        } else {
            fieldIncorrect($tbRepeatPassword);
        }
    }

    // FORM SUBMITION
    let checkFunctions = [checkUsername, checkEmail, checkPassword, checkRepeatPassword];
    $('#btnRegister').click(function() {
        return submitForm(checkFunctions);
    });
});