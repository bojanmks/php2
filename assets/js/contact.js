$(document).ready(function() {
    // FORM VALIDATION
    // NAME
    let regExpName = /^[A-ZŠĐČĆŽ][a-zšđčćž]{2,}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,})*$/;
    let $tbName = $('#tbName');
    $tbName.blur(checkName);
    function checkName() {
        validateField($tbName, regExpName);
    }

    // EMAIL
    let regExpEmail = /^[a-z][a-z0-9-_\.]{2,}@([a-z0-9-_]{2,}\.)+[a-z]{2,}$/;
    let $tbEmail = $('#tbEmail');
    $tbEmail.blur(checkEmail);
    function checkEmail() {
        validateField($tbEmail, regExpEmail);
    }

    // MESSAGE
    let $tbMessage = $('#tbMessage');
    function checkMessage() {
        let numberOfSpaces = tbMessage.value.replace(/[^\s]/mg, "").length;
        if(tbMessage.value.length - numberOfSpaces < 20 || tbMessage.value.length > 500) {
            fieldIncorrect($tbMessage);
        } else {
            fieldCorrect($tbMessage);
        }
    }
    $tbMessage.blur(checkMessage);

    // FORM SUBMITION
    let checkFunctions = [checkName, checkEmail, checkMessage];
    $('#btnSend').click(function() {
        return submitForm(checkFunctions);
    });
});