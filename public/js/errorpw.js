const form_register = document.getElementById("form-register");
const password = document.getElementById("password");
const passwordConfirm = document.getElementById("password-confirm");

form_register.addEventListener("submit", (e) => {
    e.preventDefault();
    const password1 = password.value.trim();
    const password2 = passwordConfirm.value.trim();
    if (password2 !== password1) {
        setError("La password non è uguale");
    } else {
        console.log("giusta");
        e.currentTarget.submit();
    }

    /* validateInputs(); */
});

const setError = (message) => {
    console.log("entrato");
    const inputControl = document.getElementById("error");
    console.log(inputControl);
    inputControl.classList.add("text-danger");
    inputControl.innerText = message;
};
