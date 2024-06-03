//menu a tendina
function menuTendina(event){
  const opzioni = document.querySelector('#tendina');
  opzioni.classList.remove('hidden');
  event.currentTarget.removeEventListener('click', menuTendina);
  event.currentTarget.addEventListener('click', nascondiMenu);
}

function nascondiMenu(event){
  const opzioni = document.querySelector('#tendina');
  opzioni.classList.add('hidden');
  event.currentTarget.removeEventListener('click', nascondiMenu);
  event.currentTarget.addEventListener('click', menuTendina);
}

const menu = document.querySelector('#strisce');
menu.addEventListener('click', menuTendina);

//prenotazioni
function aggiungiPrenotazione(event) {
      event.preventDefault();
      const formData = new FormData(document.querySelector('#bloccodx'));

      fetch("prenotazioni.php", { 
        method: 'POST',
        body: formData
      })
      .then(onResponse)
      .then(onJsonAddPreno)
      .catch(onError);
    }

    function onError(error){
        console.error('Error:', error);
    }
  
    function onResponse(response) {
      console.log('Response status:', response.status);
      return response.json();
    }
  
    function onJsonAddPreno(json) {
        console.log('Risposta JSON:', json);
        if (json.status === 'success') {
            const messaggioConferma = document.querySelector("#messaggioConferma");
            messaggioConferma.classList.remove('hidden');
        } else {
            console.error("Errore nella risposta JSON:", json);
        }
    }
  
    const form = document.querySelector("#bloccodx");
    form.addEventListener('submit', aggiungiPrenotazione);