const form = document.forms['login'];
form.addEventListener("submit", validazione);

function validazione(event) {
    if (form.username.value.length == 0 || form.password.value.length == 0) {
        event.preventDefault();

        const errorMessage = document.createElement('p');
        errorMessage.classList.add('error');
        errorMessage.textContent = 'Compilare tutti i campi';

        form.appendChild(errorMessage);
    }
}
