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

//vini
function displayResults(data) {
  console.log(data);
  const resultsContainer = document.querySelector('#results');
  resultsContainer.innerHTML = '';

  if (!data|| !data.recommendedWines || data.recommendedWines.length === 0) {
    const noResultsElement = document.createElement('p');
    noResultsElement.textContent = 'Nessun vino raccomandato trovato.';
    resultsContainer.appendChild(noResultsElement);
    return;
  }

  for (let i = 0; i < data.recommendedWines.length; i++) {
    const wine = data.recommendedWines[i];
  
    const wineElement = document.createElement('div');
    wineElement.classList.add('risultato');
  
    const titleElement = document.createElement('h2');
    titleElement.textContent = wine.title;
    wineElement.appendChild(titleElement);
  
    if (wine.description) {
      const descriptionElement = document.createElement('p');
      descriptionElement.textContent = wine.description;
      wineElement.appendChild(descriptionElement);
    }
  
    if (wine.price) {
      const priceElement = document.createElement('p');
      priceElement.textContent = 'Prezzo: ' + wine.price;
      wineElement.appendChild(priceElement);
    }
  
    resultsContainer.appendChild(wineElement);
  }
}

function onResponse(response) {
  console.log('Risposta ricevuta');
  return response.json();
}

function onError(error) {
  console.log('Error: ' + error);
}

function cerca(event) {
  event.preventDefault();
  const query = document.querySelector('#searchQuery').value;
  fetch('vini.php?q=' + query).then(onResponse).then(displayResults).catch(onError);
}

const cercaButton = document.querySelector('#viniForm');
cercaButton.addEventListener('submit', cerca);

//piatti
function dispatchResponse(response) {
  return response.json().then(databaseResponse).then(dispatchError);
}

function dispatchError(error) { 
  console.log("Errore: "+ error);
}

function databaseResponse(json) {
  console.log('Risposta JSON valida', json);
  const messaggioConferma = document.createElement('div');
  messaggioConferma.classList.add('popup');
  document.body.appendChild(messaggioConferma);
  if (json.ok) {
    messaggioConferma.textContent = 'Aggiunto ai preferiti!';
  } else{
    messaggioConferma.textContent = json.error;
  }
  setTimeout(function() {
    messaggioConferma.remove();
  }, 2000);
}

function aggiungiPrefe(event) {
  console.log("Salvataggio")
  const button = event.currentTarget; 
  const card = button.closest('.piatto');

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

  fetch("aggiungi_preferito.php", {method: 'post', body: formData}).then(dispatchResponse, dispatchError);
  event.stopPropagation();
}

function sonResponse(response) {
  console.log('Risposta ricevuta');
  return response.json();
}

function sonJson(json) {
  console.log('JSON ricevuto');
  console.log(json);
  
  const library = document.querySelector('#piatti');
  library.innerHTML = '';
  library.classList.add('tipologia');
  
  const risultati = json;
  let num_risultati = risultati.length;
  
  for (let i = 0; i < num_risultati; i++) {
    const piatto = risultati[i];
    const piatto_id = piatto.id;
    const titolo = piatto.nome;
    const immagine = piatto.img_url;
    const descr = piatto.descrizione;
    const costo = piatto.prezzo;

    const card = document.createElement('div');
    card.dataset.id = piatto_id;
    card.dataset.nome = titolo;
    card.dataset.descrizione = descr;
    card.dataset.prezzo = costo;
    card.dataset.image = immagine;
    card.classList.add('piatto');

    const img = document.createElement('img');
    img.src = immagine;

    const div = document.createElement('div');
    div.classList.add('descrizione');
    const caption = document.createElement('h4');
    caption.textContent = titolo;
    div.appendChild(caption);
    const descrizione = document.createElement('p');
    descrizione.textContent = descr;
    div.appendChild(descrizione);

    const favorites = document.createElement('button');
    favorites.textContent = '❤';
    favorites.classList.add('prefe');
    const price = document.createElement('p');
    price.textContent = costo;
    div.appendChild(price);

    if (i % 2 === 0) { 
      card.appendChild(img);
      card.appendChild(div);
      card.appendChild(favorites);
    } else { 
      card.appendChild(favorites);
      card.appendChild(div);
      card.appendChild(img);
    }
    library.appendChild(card);

    favorites.addEventListener('click', aggiungiPrefe);
    console.log(card);
  }

}

function search(event) {
  event.preventDefault();
  const tipologia = document.querySelector('#tipologia').value;
  fetch('piatti.php?tipologia=' + tipologia)
    .then(sonResponse)
    .then(sonJson);
}

const searchButton = document.querySelector('#menuForm');
searchButton.addEventListener('submit', search);