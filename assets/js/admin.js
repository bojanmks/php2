$(document).ready(function() {
    // === brands ===
    // FORM VALIDATION
    // NAME
    let regExpBrandName = /^[A-Za-z\s]+$/;
    let $tbAddBrandName = $('#tbAddBrandName');
    $tbAddBrandName.blur(checkAddBrandName);
    function checkAddBrandName() {
        validateField($tbAddBrandName, regExpBrandName);
    }

    let $tbEditBrandName = $('#tbEditBrandName');
    $tbEditBrandName.blur(checkEditBrandName);
    function checkEditBrandName() {
        validateField($tbEditBrandName, regExpBrandName);
    }

    // FORM SUBMITION
    let checkFunctionsAddBrand = [checkAddBrandName];
    $('#btnAddBrand').click(function() {
        return submitForm(checkFunctionsAddBrand);
    });

    let checkFunctionsEditBrand = [checkEditBrandName];
    $('#btnEditBrand').click(function() {
        return submitForm(checkFunctionsEditBrand);
    });

    // === os ===
    // FORM VALIDATION
    // NAME
    let regExpOSName = /^[A-Za-z\s]+$/;
    let $tbAddOSName = $('#tbAddOSName');
    $tbAddOSName.blur(checkAddOSName);
    function checkAddOSName() {
        validateField($tbAddOSName, regExpOSName);
    }

    let $tbEditOSName = $('#tbEditOSName');
    $tbEditOSName.blur(checkEditOSName);
    function checkEditOSName() {
        validateField($tbEditOSName, regExpOSName);
    }

    // FORM SUBMITION
    let checkFunctionsAddOS = [checkAddOSName];
    $('#btnAddOS').click(function() {
        return submitForm(checkFunctionsAddOS);
    });

    let checkFunctionsEditOS = [checkEditOSName];
    $('#btnEditOS').click(function() {
        return submitForm(checkFunctionsEditOS);
    });

    // === orders ===
    // FORM VALIDATION
    // NAME
    let regExpOrderName = /^[A-ZŠĐČĆŽ][a-zšđčćž]{2,}(\s[A-ZŠĐČĆŽ][a-zšđčćž]{2,})+$/;
    let $tbEditOrderName = $('#tbEditOrderName');
    $tbEditOrderName.blur(checkEditOrderName);
    function checkEditOrderName() {
        validateField($tbEditOrderName, regExpOrderName);
    }

    // ADDRESS
    let regExpOrderAddress = /^[A-ZŠĐČĆŽ][a-zšđčćž]{2,}(\s[A-ZŠĐČĆŽa-zšđčćž][a-zšđčćž]{2,})*\s\d+[A-Z]?(\/\d+)*$/;
    let $tbEditOrderAddress = $('#tbEditOrderAddress');
    $tbEditOrderAddress.blur(checkEditOrderAddress);
    function checkEditOrderAddress() {
        validateField($tbEditOrderAddress, regExpOrderAddress);
    }

    // FORM SUBMITION
    let checkFunctionsEditOrder = [checkEditOrderAddress];
    $('#btnEditOrder').click(function() {
        return submitForm(checkFunctionsEditOrder);
    });

    // === users ===
    // FORM VALIDATION
    // USERNAME
    let regExpUsername = /^[a-zA-Z]\w{4,20}$/;
    let $tbAddUserUsername = $('#tbAddUserUsername');
    $tbAddUserUsername.blur(checkAddUserUsername);
    function checkAddUserUsername() {
        validateField($tbAddUserUsername, regExpUsername);
    }

    let $tbEditUserUsername = $('#tbEditUserUsername');
    $tbEditUserUsername.blur(checkEditUserUsername);
    function checkEditUserUsername() {
        validateField($tbEditUserUsername, regExpUsername);
    }

    // EMAIL
    let regExpEmail = /^[a-z][a-z0-9-_\.]{2,}@([a-z0-9-_]{2,}\.)+[a-z]{2,}$/;
    let $tbAddUserEmail = $('#tbAddUserEmail');
    $tbAddUserEmail.blur(checkAddUserEmail);
    function checkAddUserEmail() {
        validateField($tbAddUserEmail, regExpEmail);
    }

    let $tbEditUserEmail = $('#tbEditUserEmail');
    $tbEditUserEmail.blur(checkEditUserEmail);
    function checkEditUserEmail() {
        validateField($tbEditUserEmail, regExpEmail);
    }

    // PASSWORD
    let regExpPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
    let $tbAddUserPassword = $('#tbAddUserPassword');
    $tbAddUserPassword.blur(checkAddUserPassword);
    function checkAddUserPassword() {
        validateField($tbAddUserPassword, regExpPassword);
    }

    let $tbEditUserPassword = $('#tbEditUserPassword');
    $tbEditUserPassword.blur(checkEditUserPassword);
    function checkEditUserPassword() {
        if(!$('#tbEditUserPassword').prop('disabled')) {
            validateField($tbEditUserPassword, regExpPassword);
        }
    }

    // FORM SUBMITION
    let checkFunctionsAddUser = [checkAddUserUsername, checkAddUserEmail, checkAddUserPassword];
    $('#btnAddUser').click(function() {
        return submitForm(checkFunctionsAddUser);
    });

    let checkFunctionsEditUser = [checkEditUserEmail, checkEditUserPassword, checkEditUserUsername];
    $('#btnEditUser').click(function() {
        return submitForm(checkFunctionsEditUser);
    });

    if($('#chbChangePassword').prop('checked')) {
        $('#tbEditUserPassword').prop('disabled', false);
    } else {
        $('#tbEditUserPassword').prop('disabled', true);
    }
    $('#chbChangePassword').change(function() {
        if(this.checked) {
            $('#tbEditUserPassword').prop('disabled', false);
        } else {
            $('#tbEditUserPassword').prop('disabled', true);
            fieldNeutral($tbEditUserPassword);
        }
    });

    // === phones ===
    // FORM VALIDATION
    // NAME
    let regExpPhoneName = /^[A-Za-z0-9\/\-\s]+$/;
    let $tbAddPhoneName = $('#tbAddPhoneName');
    $tbAddPhoneName.blur(checkAddPhoneName);
    function checkAddPhoneName() {
        validateField($tbAddPhoneName, regExpPhoneName);
    }

    let $tbEditPhoneName = $('#tbEditPhoneName');
    $tbEditPhoneName.blur(checkEditPhoneName);
    function checkEditPhoneName() {
        validateField($tbEditPhoneName, regExpPhoneName);
    }

    // PRICE
    let $tbAddPhonePrice = $('#tbAddPhonePrice');
    $tbAddPhonePrice.blur(checkAddPhonePrice);
    function checkAddPhonePrice() {
        if($('#tbAddPhonePrice').val() == '') {
            noErrors = false;
            fieldIncorrect($tbAddPhonePrice);
        } else {
            fieldCorrect($tbAddPhonePrice);
        }
    }

    let $tbEditPhonePrice = $('#tbEditPhonePrice');
    $tbEditPhonePrice.blur(checkEditPhonePrice);
    function checkEditPhonePrice() {
        if($('#tbEditPhonePrice').val() == '') {
            noErrors = false;
            fieldIncorrect($tbEditPhonePrice);
        } else {
            fieldCorrect($tbEditPhonePrice);
        }
    }

    // IMAGE
    let $fileAddPhoneImage = $('#fileAddPhoneImage');
    $fileAddPhoneImage.on('input', checkAddPhoneImage);
    function checkAddPhoneImage() {
        if($('#fileAddPhoneImage').val() == '') {
            noErrors = false;
            fieldIncorrect($fileAddPhoneImage);
        } else {
            fieldCorrect($fileAddPhoneImage);
        }
    }

    let $fileEditPhoneImage = $('#fileEditPhoneImage');
    $fileEditPhoneImage.on('input', checkEditPhoneImage);
    function checkEditPhoneImage() {
        if(!$('#fileEditPhoneImage').prop('disabled')) {
            if($('#fileEditPhoneImage').val() == '') {
                noErrors = false;
                fieldIncorrect($fileEditPhoneImage);
            } else {
                fieldCorrect($fileEditPhoneImage);
            }
        }
    }

    if($('#chbChangeImage').prop('checked')) {
        $('#fileEditPhoneImage').prop('disabled', false);
    } else {
        $('#fileEditPhoneImage').prop('disabled', true);
    }
    $('#chbChangeImage').change(function() {
        if(this.checked) {
            $('#fileEditPhoneImage').prop('disabled', false);
        } else {
            $('#fileEditPhoneImage').prop('disabled', true);
            fieldNeutral($fileEditPhoneImage);
        }
    });

    // FORM SUBMITION
    let checkFunctionsAddPhone = [checkAddPhoneName, checkAddPhonePrice, checkAddPhoneImage];
    $('#btnAddPhone').click(function() {
        return submitForm(checkFunctionsAddPhone);
    });

    let checkFunctionsEditPhone = [checkEditPhoneName, checkEditPhonePrice, checkEditPhoneImage];
    $('#btnEditPhone').click(function() {
        return submitForm(checkFunctionsEditPhone);
    });
});