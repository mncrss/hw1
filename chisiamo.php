<?php
 session_start();
 if(!isset($_SESSION["username"])) {
    header("Location: accesso.php"); 
    exit; 
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset = "utf-8">
    <title>NITTO</title>
    <link rel="stylesheet" href="chisiamo.css" />
    <link href="https://fonts.googleapis.com/css2?family=Elsie+Swash+Caps:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <script src = "chisiamo.js" defer></script>
  </head>

  <body>
    <nav id = "navigazione">
      <img src="immagini/logo-header-1.png"/>
      <div class ="info">
        <a href = "homepage.php">Home</a>
        <a href = "chisiamo.php">Chi Siamo</a>
        <a href = "menu.php">Menù</a>
        <a href = "prenotazioni.php">Prenota</a>
        <a href = "profile.php">Profilo</a>
        <a href = "https://www.facebook.com/Oasifruttidimare/"><img src="immagini/facebook_logo_icon_181322.png"></a>          
        <a href = "https://www.instagram.com/oasi_frutti_di_mare_da_nitto/"><img src="immagini/Instagram-PNGinstagram-icon-png.png"></a>
      </div>
        
      <div id = "tenda">
        <div id="strisce">
          <div></div>            
          <div></div>
          <div></div>
        </div>
        <div id="tendina" class = "hidden">
          <a href = "homepage.php">Home</a>
          <a href = "chisiamo.php">Chi Siamo</a>
          <a href = "menu.php">Menù</a>
          <a href = "prenotazioni.php">Prenota</a>
          <a href = "profile.php">Profilo</a>
          <a href = "https://www.facebook.com/Oasifruttidimare/">Facebook</a>
          <a href = "https://www.instagram.com/oasi_frutti_di_mare_da_nitto/">Instagram</a>
        </div>
      </div>
    </nav>

    <section id="chi">
        <div>
            <h1>Chi siamo</h1>
            <h2>OASI FRUTTI DI MARE DA NITTO</h2>
            <p>Con sacrificio e determinazione, i frutti del sudore sono maturati con la soddisfazione dei nostri clienti affettuosi, portando a tavola la freschezza del nostro pesce e dei nostri frutti di mare a Catania.
                Nitto, un uomo con una grande inventiva, è stato il primo a Catania a vendere i ricci di mare aperti!
                Pian piano che i suoi figli crescevano gli trasmise la sua passione per questo lavoro, e con tanto amore ingrandimmo la nostra attività. Non vendendo più solo frutti di mare ma fu inserito pure lo street food. Dove cuciniamo (tutt’ora) sul momento tutto quello che viene esposto crudo.
                La nostra attività si distinse dalle altre grazie alla nostra clientela, non solo composta da catanesi ma anche da turisti che vengono per gustare le nostre prelibatezze, affermando che ormai, per chi viene a Catania, “Nitto” sia diventata una tappa obbligatoria da non sorvolare.</p>
        </div>
        <img src ="immagini/nitto1.jpeg">
    </section>
        
    <section id="show">
        <div class="kkk">
        <h2>Podcast di cucina</h2>
         <p>...ascolta, sperimenta, gusta...</p>
        </div>
        <form id="spotify">
            Inserisci l'ID di un podcast:
            <input type='text' id='podcast' placeholder="es. 2wE0NnMV8higiwFsgx32Pf">
            <input type='submit' id='submit' value='Cerca'>
        </form>
        <span class="id_spoti">Mostra id dei podcast</span>
        <div class="elenco"></div>
    </section>
    
    <div id="podcast-view"></div>

    <footer>
      <div id="end">
        <img src="immagini/logo-header-1.png" class="palma">
        <p class="finale">Piazza Mancini Battaglia n. 2/4/5/6 – 95126 Catania<br>
          Tel. 095 491165 / 095 493583<br>
          Cell. 347 303 0647 / 351 533 2632<br>
          Email: oasifruttidimaredanitto@gmail.com</p>
        <div id="social-media">
          <a href = "https://www.facebook.com/Oasifruttidimare/"><img src="immagini/facebook_logo_icon_181322.png" class="lg"></a>
          <a href = "https://www.instagram.com/oasi_frutti_di_mare_da_nitto/"><img src="immagini/Instagram-PNGinstagram-icon-png.png" class="lg"></a>
        </div>
      </div>
      <div class="cookies">
        <p>COOKIES  |  PRIVACY POLICY   |  SITEMAP</p>
      </div> 
      <div class = "copyright">
        <p>© 2023 OASI DA NITTO S.R.L.S P.IVA: 05791330870 | Sito web realizzato ed ottimizzato da PRISMI S.p.a.</p>
      </div>
    </footer>

    <a href="https://api.whatsapp.com/send/?phone=393886990555&text&type=phone_number&app_absent=0"><img src="immagini/whatsapp_logo_icon_147205.png" class = "whatsapp"></a>
  </body>
</html>