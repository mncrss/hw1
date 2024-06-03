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

//id podcast
const id_podcast = [
    'Cronache di Cucina: 2wE0NnMV8higiwFsgx32Pf',
    'Mangia come parli: 30TKFq5XsUKPyFjeEfAiXB',
    'Generi di conforto: 7fBO69OvRC95chpOko5MP1',
    'DOI - Denominazione di Origine Inventata: 4HAxuHe75m4b1Wq0sAtBkV',
    'Lievito Madre: 4BbYFSN0Zn2JlPLvgnLhfu',
    'Che Pizza - Il podcast: 6NDPAJfE31aoOv37w0wTNo',
    'Mikettä - Tutto il pane del mondo: 33Dns6PzVB2S4SHXuTahQK',
    'IO SONO CUCINA: 4UCDNxsnHLJMfpgS408YP5',
    'Juice It Up: 4oMQZ5JKpYMQqsMrIlJ6dw',
    'La Retroetichetta: 6Nb3gAOnIQ7gx9lnWi2bED',
    'A tavola con Giulio Cesare: 1hxmdppsGngh2a4IIGSG3y',
    'diVino: 0X3jdGd8CwRkNSbPZLoJ6q',
    'Corso per Sommelier di A.I.S. (Associazione Italiana Sommelier): 3zMvHiGOHCMTsdh7YrupY6'
  ];
  
  function mostraElenco(event){
    const lista = event.currentTarget;
    const elenco = document.querySelector('.elenco');
    elenco.innerHTML = "";
    for(let i = 0; i<id_podcast.length; i++){
      const scritta = document.createElement('li');
      scritta.textContent = id_podcast[i];
      elenco.appendChild(scritta);
    }
    elenco.classList.remove('hidden');
    lista.removeEventListener('mouseover', mostraElenco);
    elenco.addEventListener('mouseleave', nascondiElenco);
  }
  
  function nascondiElenco(event){
    const elenco = event.currentTarget;
    const lista = document.querySelector('.id_spoti');
    elenco.classList.add('hidden');
    lista.addEventListener('mouseover', mostraElenco);
  }
  
  const lista_id = document.querySelector('.id_spoti');
  lista_id.addEventListener('mouseover', mostraElenco);
  
//spotify
function search(event) {
  event.preventDefault();
  const podcast_input = document.querySelector('#podcast');
  const podcast_value = encodeURIComponent(podcast_input.value);
  console.log('Eseguo ricerca: ' + podcast_value);
  
  fetch('spotify.php?q=' + podcast_value)
      .then(response => {
          if (!response.ok) {
              throw new Error('Errore nella risposta della rete');
          }
          return response.json();
      })
      .then(onJson)
      .catch(error => {
          console.error('Errore:', error);
      });
}

function onJson(json) {
  console.log('JSON ricevuto');
  console.log(json);
  const library = document.querySelector('#podcast-view');
  library.innerHTML = '';
  const results = json.shows;
  let num_results = results.length;
  if(num_results > 5)
    num_results = 5;
  for (let i = 0; i < num_results; i++) {
    const podcast_data = results[i];
    const title = podcast_data.name;
    const selected_image = podcast_data.images[0].url;
    const didascalia = podcast_data.description;
    const episodi = podcast_data.total_episodes;
    const editore = podcast_data.publisher;
    const podcast = document.createElement('div');
    podcast.classList.add('podcast');
    const img = document.createElement('img');
    img.src = selected_image;
    const caption = document.createElement('h3');
    caption.textContent = title;
    const describe = document.createElement('p');
    describe.classList.add('text')
    describe.textContent = didascalia;
    const div = document.createElement('div');
    div.classList.add('riga_spotify');
    const episodes = document.createElement('p');
    episodes.textContent = 'Numero episodi: ' + episodi;
    const publisher = document.createElement('p');
    publisher.textContent = 'Editore: ' + editore;
    episodes.classList.add('text');
    publisher.classList.add('text');
    podcast.appendChild(caption);
    podcast.appendChild(describe);
    div.appendChild(episodes);
    div.appendChild(publisher);
    podcast.appendChild(div);
    library.appendChild(podcast);
    library.appendChild(img);
  }
}

const form = document.querySelector('#spotify');
form.addEventListener('submit', search);