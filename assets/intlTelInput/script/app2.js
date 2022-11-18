// mobile2

var input = document.querySelector("#mobile2"),
    errorMsg = document.querySelector("#error-msg"),
    validMsg = document.querySelector("#valid-msg");

// Error messages based on the code returned from getValidationError
var errorMap = [ "Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

// Initialise plugin
var intl = window.intlTelInput(input, {
    utilsScript: "<?php base_url(); ?>assets/intlTelInput/js/utils.js"
});

var reset = function() {
    input.classList.remove("error");
    errorMsg.innerHTML = "";
    errorMsg.classList.add("hide");
    validMsg.classList.add("hide");
};

// Validate on blur event
input.addEventListener('blur', function() {
    reset();
    if(input.value.trim()){
        if(intl.isValidNumber()){
            validMsg.classList.remove("hide");
        }else{
            input.classList.add("error");
            var errorCode = intl.getValidationError();
            errorMsg.innerHTML = errorMap[errorCode];
            errorMsg.classList.remove("hide");
        }
    }
});

// Reset on keyup/change event
input.addEventListener('change', reset);
input.addEventListener('keyup', reset);