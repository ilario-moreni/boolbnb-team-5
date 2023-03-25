// Logica validazione frontend

const form = document.querySelector(".form");
const title = document.getElementById('title');
const rooms = document.getElementById('rooms');
const beds = document.getElementById('beds');
const bathrooms = document.getElementById('bathrooms');
const latitude = document.getElementById('latitude');
const longitude = document.getElementById('longitude');
let valid = false;

form.addEventListener('submit', e => {

    if (valid === false) {
        e.preventDefault();
        validateInputs();
    }
    else {
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

function validateInputs(e) {
    const titleValue = title.value.trim();
    const roomsValue = rooms.value.trim();
    const bedsValue = beds.value.trim();
    const bathroomsValue = bathrooms.value.trim();
    const latitudeValue = latitude.value.trim();
    const longitudeValue = longitude.value.trim();

    if (titleValue === '') {
        setError(title, 'Titolo richiesto')
    }
    else if (titleValue.length > 100) {
        setError(title, 'Il titolo è troppo lungo - max 100 caratteri')
    }
    else {
        setSuccess(title);
    }

    if (roomsValue === '') {
        setError(rooms, 'Numero stanze richiesto')
    }
    else {
        setSuccess(rooms);
    }

    if (bedsValue === '') {
        setError(beds, 'Numero di letti richiesto')
    }
    else {
        setSuccess(beds);
    }

    if (bathroomsValue === '') {
        setError(bathrooms, 'Numero bagni richiesto')
    }
    else {
        setSuccess(bathrooms);
    }

    if (latitudeValue === '') {
        setError(latitude, 'Latitudine richiesta')
    }
    else {
        setSuccess(latitude);
    }

    if (longitudeValue === '') {
        setError(longitude, 'Longitudine richiesta')
    }
    else {
        setSuccess(longitude);
    }

    valid = true;
}