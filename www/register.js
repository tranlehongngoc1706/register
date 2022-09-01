//Input
const form = document.getElementById('form');
const username = document.getElementById('username');
const password = document.getElementById('password');
const c_password = document.getElementById('c_password');
const business_name = document.getElementById('business_name');
const business_address = document.getElementById('business_address');
const your_name = document.getElementById('your_name');
const your_address = document.getElementById('your_address');
const submit = document.getElementById('btn')

//Color
const green = '#4CAF50';
const red = '#F44336';

//Handle form
form.addEventListener('act', function(event) {
    event.preventDefault();
    
})

//Validate
function validateUsername(){
    if (checkIfEmpty(username)) return;
    if (!checkUsername(username)) return;
    if (!checkLength(username,8,15)) return;
    return true;
}

function validatePassword(){
    if (checkIfEmpty(password)) return;
    if (!checkPassword(password)) return;
    if (!checkLength(password,8,20)) return;
    return true;
}

function validateConfirmPassword(){
    if (checkIfEmpty(c_password)) return;
    if (!checkConfirmPassword(c_password)) return;
    return true
}

function validateBusinessName(){
    if (checkIfEmpty(business_name)) return;
    if (!checkLength2(business_name,5)) return;
    return true;
}

function validateBusinessAddress(){
    if (checkIfEmpty(business_address)) return;
    if (!checkLength2(business_address,5)) return;
    return true;
}

function validateYourName(){
    if (checkIfEmpty(your_name)) return;
    if (!checkLength2(your_name,5)) return;
    return true;
}

function validateYourAddress(){
    if (checkIfEmpty(your_address)) return;
    if (!checkLength2(your_address,5)) return;
    return true;
}

// Sub-functions
function checkIfEmpty(field){
    if(isEmpty(field.value.trim())){
        setInvalid(field, `${field.name} must not be empty`)
        return true;
    } else {
        setValid(field);
        return false;
    }
}

function isEmpty(value) {
    if(value === '') return true;
    return false;
}

function setInvalid(field,message) {
    field.className = 'invalid';
    field.nextElementSibling.innerHTML = message;
    field.nextElementSibling.style.color = red; 
}

function setValid(field) {
    field.className = 'valid';
    field.nextElementSibling.innerHTML = '';
}

function checkUsername(field) {
    if (/^[a-zA-Z0-9]+$/.test(field.value)) {
        setValid(field);
        return true;
    } else {
        setInvalid(field, `${field.name} must contain only letters and digits`);
        return false;
    }
}

function checkPassword(field) {
    if (/[a-zA-z0-9]+[!|@|#|$|%|^|&|*]+$/.test(field.value)) {
        setValid(field);
        return true;
    } else {
        setInvalid(field, `${field.name} must contain at least one upper case letter, at least one lower case letter, at least one digit, at least one special letter in the set !@#$%^&* and NO other kind of characters`);
        return false;
    }
}

function checkLength(field, min, max) {
    if(field.value.length >= min & field.value.length <= max) {
        setValid(field);
        return true;
    } else if(field.value.length < min) {
        setInvalid(field, `${field.name} must contain at least ${min} characters`);
        return false;
    } else (field.value.length > max); {
        setInvalid(field, `${field.name} must contain at most ${max} characters`);
        return false;
    }

}

function checkLength2(field, min) {
    if(field.value.length >= min) {
        setValid(field);
        return true;
    } else {
        setInvalid(field, `${field.name} must contain at least ${min} characters`);
        return false;
    }
}

function checkConfirmPassword() {
    if(password.className !== 'valid') {
        setInvalid(c_password, 'Password must be valid');
        return false;
    } 

    if(c_password.value !== password.value) {
        setInvalid(c_password, 'Passwords must match');
        return false;
    } else {
        setValid(c_password);
    }
    return true;
}

function unique(input) {
    return new Set(input).size === str.length;
}


/*Below are the constraints you must enforce on the registration pages
username: unique
(the shipper's distribution hub, which is a drop-down select)
Except the uniqueness constraint, all other constraints must be validated at both the client side (use JavaScript) and the server side (use PHP)*/