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
  
  //cambio sfondo header
  const sfondi = [
    'url("immagini/AdobeStock_353560265.jpg")',
    'url("immagini/AdobeStock_246750740.jpg")',
    'url("immagini/Home-slider-1.jpg")'
  ];
  let indiceSfondo = 0;
  
  function cambioSfondo() {
    indiceSfondo = (indiceSfondo + 1) % sfondi.length;
    document.querySelector("#background").style.backgroundImage = sfondi[indiceSfondo];
  }
  
  const freccia = document.querySelectorAll('#frecce img'); 
  for (let i = 0; i < freccia.length; i++) {
    freccia[i].addEventListener('click', cambioSfondo);
  }
  
  //Funzione Scopri di più
  const descrizioni = {
    Pescheria: {
      descrizione: "Tutti i giorni selezioniamo per Voi il miglior pescato, pesce fresco di mare, crostacei e  prodotti locali."
    },
  
    StreetFood: {
      descrizione: "Pranzo e cena in pescheria, tutta la nostra gastronomia marinara pronta per essere gustata da voi, il tutto è sempre accompagnato da ottimi vini locali e non."
    },
  
    Aperifish: {
      descrizione:"Durante il nostro aperitivo in pescheria verrai coinvolto dalle nostre cruditè con tartare, ostriche e crostacei e dai nostri vini ghiacciati."
    }
  }
  
  function mostraDescrizione(event){
    const descr = event.currentTarget;
    const sezione = descr.dataset.sezione;
    descr.textContent=descrizioni[sezione].descrizione;
    descr.classList.add('mostra_descrizione');
    descr.removeEventListener('click', mostraDescrizione);
    descr.addEventListener('click', nascondiDescrizione);
  }
  
  function nascondiDescrizione(event){
    const descr = event.currentTarget;
    descr.classList.remove('mostra_descrizione');
    descr.textContent = 'Scopri di più';
    descr.removeEventListener('click', nascondiDescrizione); 
    descr.addEventListener('click', mostraDescrizione);
  }
  
  const Scopri = document.querySelectorAll('.post_content');
  for(const postContent of Scopri){
    postContent.addEventListener('click', mostraDescrizione);
  }
  
  //cambiare le immagini al passaggio del mouse
  const imgg = [
    'immagini/76.jpg',
    'immagini/77.jpg',
    'immagini/78.jpg'
  ];
  
  const original = [
    'immagini/IMG-20231203-WA0003-400x250.jpg',
    'immagini/IMG-20231203-WA0001-1-400x250.jpg',
    'immagini/IMG-20231203-WA0005-1-400x250.jpg'
  ];
  
  function cambioImmagini(event)
  {
    const images = event.currentTarget;
    const indice = parseInt(images.dataset.indice);
    images.src = imgg[indice];
  }
  
  function ripristinaImmagini(event){
    const images = event.currentTarget;
    const indice = parseInt(images.dataset.indice);
    images.src = original[indice];
  }
  
  const images = document.querySelectorAll('.post img');
  for (let i = 0; i < images.length; i++) {
    images[i].setAttribute('data-indice', i);
    images[i].addEventListener('mouseover', cambioImmagini);
    images[i].addEventListener('mouseout', ripristinaImmagini);
  }
  
  //galleria
  const lista_immagini = [
    "immagini/FB_IMG_1587027909317-Custom.png",
    "immagini/FB_IMG_1587027834564-Custom.png",
    "immagini/FB_IMG_1587027951663-Custom.png",
    "immagini/FB_IMG_1587027847786-Custom.jpg",            
    "immagini/98053950_1322535031276681_3760812465483415552_o-Custom.jpg"
  ];
  
  function createImage(src){
    const image = document.createElement('img');
    image.src = src;
    return image;
  }
  
  const album = document.querySelector('#galleria-items');
  for(let i = 0; i < lista_immagini.length; i++){
    const src_foto = lista_immagini[i];
    const image = createImage(src_foto);
    image.addEventListener('click', onThumbnailClick)
    album.appendChild(image);
  }
  
  function onThumbnailClick(event){
    const modalView = document.querySelector('#modal-view');
    const image = createImage(event.currentTarget.src);
    document.body.classList.add('no-scroll');
    modalView.innerHTML = '';
    modalView.appendChild(image);
    modalView.classList.remove('hidden');
  }
  
  function onModalClick(event){
    document.body.classList.remove('no-scroll');
    const modalView = document.querySelector('#modal-view');
    modalView.classList.add('hidden');
  }
  
  const modalView = document.querySelector('#modal-view');
  modalView.addEventListener('click', onModalClick);
  
  const galleriaItems = document.querySelectorAll('#galleria-items img');
  for (let i = 0; i < galleriaItems.length; i++) {
    const item = galleriaItems[i];
    item.addEventListener('click', onThumbnailClick);
  }
  
  //codice sconto
  function codiceSconto(event){
    const caratteri = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    let codice = ''; 
    for(let i = 0; i < 8; i++){
      const idx_casuale = Math.floor(Math.random() * caratteri.length);
      codice += caratteri.charAt(idx_casuale);
    }
  
    document.querySelector('#codiceSconto').textContent = codice;
    event.target.removeEventListener('click', codiceSconto);
  }
  
  const button = document.querySelector('#button');
  button.addEventListener('click', codiceSconto);

//recensioni
let ratingValue = 0;

const stars = document.querySelectorAll('.rating img');
stars.forEach(function(star) {
    star.addEventListener('click', function() {
        ratingValue = parseInt(star.dataset.value); 
        stars.forEach(function(s, i) {
            s.src = i < ratingValue ? 'immagini/star-1901588_1280.png' : 'immagini/stellavuota.png';
        });
    });
});

function aggiungiRecensione(event) {
  event.preventDefault();
  const formData = new FormData(document.querySelector('#reviewForm'));
  formData.append('rating', ratingValue);

  fetch("homepage.php", { 
    method: 'POST',
    body: formData
  }).then(onResponse).then(onJsonAddRece).catch(onError);
}

function onError(error){
  console.log('Error: ' + error);
}

function onResponse(response) {
  console.log('Response status:', response.status);
  return response.json();
}

function onJsonAddRece(json) {
  console.log('Risposta JSON:', json);
  if (json.status === 'success') {
      const messaggioConferma = document.querySelector("#messaggioConferma");
      messaggioConferma.classList.remove('hidden');
  } else {
      console.error("Errore nella risposta JSON:", json);
  }
}

const form = document.querySelector("#reviewForm");
form.addEventListener('submit', aggiungiRecensione);

//mostra recensioni
function displayRecensioni(json) {
  console.log(json);
  const resultsContainer = document.querySelector('#results');
  resultsContainer.innerHTML = '';
  resultsContainer.classList.add('recensione');

  if (json.length === 0) {
    resultsContainer.textContent = 'Nessuna recensione trovata.';
    return;
  }

  let num_results = json.length;
  if(num_results > 4 )
    num_results = 4;
  for (let i = 0; i < num_results; i++){
    const recensione = json[i];
    
    const card = document.createElement('div');
    card.classList.add('commento');

    const image = document.createElement('img');
    image.src = recensione.immagine;
    card.appendChild(image);
    image.classList.add('foto');

    const username = document.createElement('p');
    username.textContent = recensione.username;
    card.appendChild(username);
    username.classList.add('nome-profilo');

    data = document.createElement('p');
    data.textContent = recensione.data;
    card.appendChild(data);
    data.classList.add('data')

    const punteggio = recensione.rating;
    const rating = document.createElement('div');
    rating.classList.add('stelle');
    for (let j = 0; j < punteggio; j++) {
      const stella = document.createElement('img');
      stella.src = "immagini/star-1901588_1280.png";
      stella.classList.add('star');
      rating.appendChild(stella);
    }
    for (let k = 0; k < (5 - punteggio); k++) {
      const stella = document.createElement('img');
      stella.src = "immagini/stellavuota.png";
      stella.classList.add('star');
      rating.appendChild(stella);
    }
    card.appendChild(rating);

    const testo = document.createElement('p');
    testo.textContent = recensione.recensione;
    card.appendChild(testo);
    testo.classList.add('content');

    resultsContainer.appendChild(card);
  }
}

fetch('mostra_recensioni.php')
  .then(onResponse)
  .then(displayRecensioni)
  .catch(onError);