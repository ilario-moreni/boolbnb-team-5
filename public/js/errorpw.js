// Logica validazione frontend
const form_register = document.getElementById("form-register");
const email = document.getElementById('email');
const name = document.getElementById('name');
const password = document.getElementById("password");
const passwordConfirm = document.getElementById("password-confirm");
let valid = false;

form_register.addEventListener('submit', e => {

    if (valid === false) {
        console.log('ciao if valid')
        e.preventDefault();
        validateInputs(e);
    }
    else {
        console.log('else e')
        e.currentTarget.submit()
    }
});

function setError(element, message) {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error')

    errorDisplay.innerText = message;
    errorDisplay.classList.remove('d-none');
};

function setSuccess(element) {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');
    errorDisplay.innerText = "";
    errorDisplay.classList.add('d-none');
}

function validateInputs(elem) {
    console.log('validate')
    const email_value = email.value.trim();
    const password1 = password.value.trim();
    const password2 = passwordConfirm.value.trim();
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    let isError = false;

    if (email_value === '' || email_value === null) {
        setError(email, 'Email Richiesta');
        isError = true;
        console.log(email)
    }
    else if (email_value.match(mailformat)) {
        setSuccess(email);
    }
    else {
        setError(email, 'Inserisci un email valida');
        isError = true;

    }

    if (password1 === '' || password1 === null) {
        setError(password, 'Inserisci password');
        isError = true;
    }
    else if (password2 === "" || password2 === null) {
        setError(passwordConfirm, 'Inserisci password di conferma');
        isError = true;
    }
    else if (password2 != password1) {
        setError(passwordConfirm, 'La password non è uguale');
        isError = true;
    }
    else {
        setSuccess(email);
    }

    if (!isError) {
        valid = true;
    }

    if (valid) {
        elem.currentTarget.submit()
    }
}

