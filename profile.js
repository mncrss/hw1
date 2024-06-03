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

//rimuovi preferiti
function dispatchResponse(response) {
  return response.json().then(databaseResponse).catch(dispatchError);
}

function dispatchError(error) { 
  console.log("Errore: "+ error);
}

function databaseResponse(json) {
  if (!json.ok) {
    dispatchError(json.error || 'Errore sconosciuto dal server');
    return null;
  }
  console.log('Risposta JSON valida', json);
  if (json.ok) {
    const messaggioConferma = document.createElement('div');
    messaggioConferma.textContent = 'Rimosso dai preferiti!';
    messaggioConferma.classList.add('popup');
    document.body.appendChild(messaggioConferma);
    setTimeout(function() {
      messaggioConferma.remove();
    }, 2000);
    
    const card = document.querySelector(`.prefe[data-id="${json.piatto_id}"]`);
    if (card) {
      card.remove();
    }
  }
}

function rimuoviPrefe(event) {
  console.log("Rimozione");
  const button = event.currentTarget; 
  const card = button.closest('.prefe');

  const piatto_id = card.getAttribute('data-id');
  const nome_piatto = card.getAttribute('data-nome');
  const img_url = card.getAttribute('data-image');
  const descrizione = card.getAttribute('data-descrizione');
  const prezzo = card.getAttribute('data-prezzo');

  console.log(card);

  const formData = new FormData();
  formData.append('piatto_id', piatto_id);
  formData.append('nome_piatto', nome_piatto);
  formData.append('img_url', img_url);
  formData.append('descrizione', descrizione);
  formData.append('prezzo', prezzo);

  for (const pair of formData.entries()) {
    console.log(pair[0] + ', ' + pair[1]);
  }

  fetch("rimuovi_preferito.php", {method: 'post', body: formData}).then(dispatchResponse, dispatchError);
  event.stopPropagation();
}

//mostra preferiti
function displayResults(json) {
  console.log(json);
  const resultsContainer = document.querySelector('#results');
  resultsContainer.innerHTML = '';

  if (json.length === 0) {
    resultsContainer.textContent = 'Nessun piatto preferito trovato.';
    return;
  }

  for (let i = 0; i < json.length; i++) {
    const piatto = json[i];
    const piatto_id = piatto.piatto_id;
    const title = piatto.nome_piatto;
    const immagine = piatto.img_url;
    const descr = piatto.descrizione;
    const prezzo = piatto.prezzo;
    
    const card = document.createElement('div');
    card.dataset.id = piatto_id;
    card.dataset.nome = title;
    card.dataset.descrizione = descr;
    card.dataset.prezzo = prezzo;
    card.dataset.image = immagine;
    card.classList.add('prefe');

    const favorites = document.createElement('button');
    favorites.textContent = '✖';
    favorites.classList.add('rimuovi');
    card.appendChild(favorites);

    const titolo = document.createElement('h4');
    titolo.textContent = title;
    card.appendChild(titolo);

    const img = document.createElement('img');
    img.src = immagine;
    card.appendChild(img);

    const descrizione = document.createElement('p');
    descrizione.textContent = descr;
    card.appendChild(descrizione);

    const costo = document.createElement('p');
    costo.textContent = prezzo;
    card.appendChild(costo);

    resultsContainer.appendChild(card);

    favorites.addEventListener('click', rimuoviPrefe);
  }
}

function onResponse(response) {
  return response.json();
}

function onError(error) {
  console.error('Error:', error);
}

function search(){
fetch('mostra_preferiti.php')
  .then(onResponse)
  .then(displayResults)
  .catch(onError);
}

const searchButton = document.querySelector('#preferiti');
searchButton.addEventListener('click', search);

//mostra prenotazioni
function displayPrenotazioni(json) {
  console.log(json);
  const resultsContainer = document.querySelector('#results');
  resultsContainer.innerHTML = '';

  if (json.length === 0) {
    resultsContainer.textContent = 'Nessuna prenotazione trovata.';
    return;
  }

  for (let i = 0; i < json.length; i++) {
    const prenotazioni = json[i];
    
    const card = document.createElement('div');
    card.classList.add('prefe');

    const nome = document.createElement('p');
    nome.textContent = "Nome: " + prenotazioni.nome;
    card.appendChild(nome);

    const cognome = document.createElement('p');
    cognome.textContent = "Cognome: " + prenotazioni.cognome;
    card.appendChild(cognome);

    const data = document.createElement('p');
    data.textContent = "Data: " + prenotazioni.data;
    card.appendChild(data);

    const ora = document.createElement('p');
    ora.textContent = "Ora: " + prenotazioni.ora;
    card.appendChild(ora);

    resultsContainer.appendChild(card);
  }
}

function cerca(){
fetch('mostra_prenotazioni.php')
  .then(onResponse)
  .then(displayPrenotazioni)
  .catch(onError);
}

const searchButton2 = document.querySelector('#prenotazioni');
searchButton2.addEventListener('click', cerca);