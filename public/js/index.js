/**
 * @description Toggle the visibility of the navbar
 * @param collapseID
 * @param menuCloseID
 * @param menuOpenID
 */
function toggleNavbar(collapseID, menuCloseID, menuOpenID) {
    document.getElementById(collapseID).classList.toggle('hidden');
    document.getElementById(menuCloseID).classList.toggle('hidden');
    document.getElementById(menuOpenID).classList.toggle('hidden');
}

/**
 * @description: Toggle the visibility of the dropdown
 * @param collapseID
 */
function openDropdown(collapseID) {
    document.getElementById(collapseID).classList.toggle('hidden');
}

/**
 * @description: Toggle the theme of the navbar
 * @param id
 */
function changeTheme(id) {
    let e = document.getElementById(id);
    if (e.classList.contains('translate-x-9')) {
        localStorage.theme = 'light';
        document.querySelector("html").classList.toggle("dark");
    } else {
        localStorage.theme = 'dark';
        document.querySelector("html").classList.toggle("dark");
    }
    e.classList.toggle('translate-x-9');
    e.parentElement.classList.toggle('bg-blue-600');
    e.classList.toggle('translate-x-1');
    e.parentElement.classList.toggle('bg-gray-400');
}

let e = document.getElementById("theme-switch");
if (localStorage.theme == 'light') {
    document.querySelector("html").classList.remove("dark");
    e.classList.remove('translate-x-9');
    e.parentElement.classList.remove('bg-blue-600');
    e.classList.add('translate-x-1');
    e.parentElement.classList.add('bg-gray-400');
} else {
    document.querySelector("html").classList.add("dark");
    e.classList.add('translate-x-9');
    e.parentElement.classList.add('bg-blue-600');
    e.classList.remove('translate-x-1');
    e.parentElement.classList.remove('bg-gray-400');
}

/**
 * @description Delete a product from a basket
 * @param id
 */
function deleteProduct(id) {
    let form = new FormData()
    form.append('id_product', id)
    let url = new URL(window.location.protocol + "//" + window.location.hostname + '/api/deleteProductBasket')
    fetch(url, {
        method: 'POST',
        body: form
    })
    .then(function(response) {
        console.log(JSON.parse(response))
        document.getElementById("row_product_" + id).classList.toggle("hidden")
    })
}

/**
 * @description Modify the quantity of a product in an order
 * @param id
 * @param quantity
 */
function modifyQuantity(id, quantity) {
    let form = new FormData()
    form.append('id_product', id)
    form.append('quantity', quantity)
    let url = new URL(window.location.protocol + "//" + window.location.hostname + '/api/modifyQuantityBasket')
    fetch(url, {
        method: 'POST',
        body: form
    })
    .then(function() {
        document.getElementById("quantity_" + id).innerHTML = quantity
    })
}

/**
 * @description Display / hide the password value
 * @param id
 */
function hidePassword(id) {
    let x = document.getElementById(id);
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

/**
 * @description Display the form in case the user has forgotten his password
 */
function passwordForgot(){
    document.getElementById("connection").classList.add('hidden');
    document.getElementById("password_forgot").classList.remove('hidden');
}

/**
 * @description Validate the signup form
 */
function inputValidationInscription()
{
    let email = document.getElementById("email_field");
    let special_chars = "/[!@#$%^&*()_+\-=\[\]{};'\":\\|,.<>\/?]+/";
    let lower_chars = "abcdefghijklmnopqrstuvwxyz";
    let upper_chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    let numbers_chars = "0123456789";
    let accent_chars = "éèêëÉÈÊËÀÂÄàâäÆæŒœÎÏîïÔÖôöÛÜÙûüùÇç";
    let valid_user_chars = lower_chars+upper_chars+numbers_chars+'_'+accent_chars;
    let password1 = document.getElementById("password_field_1");
    let password2 = document.getElementById("password_field_2");
    let errors = 0;

    if(password1.value.length < 6)
    {
        document.getElementById("password_field_1_error").innerHTML = "Vous devez choisir un mot de passe d'au moins 7 caractères !";
        errors += 1;
    }
    else
    {
        let lower_count = 0;
        let upper_count = 0;
        let special_count = 0;
        let numbers_count = 0;
        for(let i = 0; i < password1.value.length; i++)
        {
            if(special_chars.includes(password1.value[i])){special_count+=1;}
            if(lower_chars.includes(password1.value[i])){lower_count+=1;}
            if(upper_chars.includes(password1.value[i])){upper_count+=1;}
            if(numbers_chars.includes(password1.value[i])){numbers_count+=1;}
        }
        if(special_count === 0 || lower_count === 0 || upper_count === 0 || numbers_count === 0)
        {
            document.getElementById("password_field_1_error").innerHTML = "Votre mot de passe doit contenir au moins une minuscule, une majuscule, un caractère spécial et un chiffre";
            errors += 1;
        }
    }
    if(password2.value !== password1.value)
    {
        document.getElementById("password_field_2_error").innerHTML = "Les deux mots de passe saisis ne sont pas identiques !";
        errors += 1;
    }
    if(email.value.length === 0)
    {
        document.getElementById("email_field_error").innerHTML = "L'E-Mail est obligatoire !";
        errors += 1;
    }
    if(errors === 0)
    {
        document.forms[0].submit();
    }
}