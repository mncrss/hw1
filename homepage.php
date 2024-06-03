<?php
 session_start();
 if(!isset($_SESSION["username"])) {
    header("Location: accesso.php"); 
    exit; 
  }

  if(!empty($_POST["recensione"]) && isset($_POST["rating"])){
    $error = array();
    $conn = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_error($conn));
    $username = $_SESSION['username'];
    $immagine = $_SESSION['immagine'];
    $recensione = mysqli_real_escape_string($conn, $_POST["recensione"]);
    $rating = intval($_POST["rating"]);
    $query = "INSERT INTO recensioni(username, immagine, recensione, rating) VALUES('$username', '$immagine', '$recensione', '$rating')";

    if (mysqli_query($conn, $query)) {
      $response = array("status" => "success", "message" => "Recensione aggiunta con successo.");
    } else {
      $response = array("status" => "error", "message" => "Impossibile aggiungere la recensione.");
    }

    mysqli_close($conn);
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset = "utf-8">
    <title>NITTO</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://fonts.googleapis.com/css2?family=Elsie+Swash+Caps:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <script src = "homepage.js" defer></script>
  </head>

  <body>
    <nav id = "navigazione">
      <img src="immagini/logo-header-1.png"/>
      <div class ="info">
        <a href = "index.php">Home</a>
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
          <a href = "index.php">Home</a>
          <a href = "chisiamo.php">Chi Siamo</a>
          <a href = "menu.php">Menù</a>
          <a href = "prenotazioni.php">Prenota</a>
          <a href = "profile.php">Profilo</a>
          <a href = "https://www.facebook.com/Oasifruttidimare/">Facebook</a>
          <a href = "https://www.instagram.com/oasi_frutti_di_mare_da_nitto/">Instagram</a>
        </div>
      </div>
    </nav>
    
    <header id = "background">
      <div id = "frecce">
        <img src = 'immagini/left.png'>
        <h1>Benvenuto<br><?php print_r($_SESSION["username"]) ?></h1>
        <img src = 'immagini/rightarrow1_78511.png'>
      </div>
    </header>

    <section class="introduzione">
      <div id = "paragrafo"> 
        <div class="line">
          <p>NITTO</p>
          <h2>Oasi frutto di mare</h2>          
        </div>
        <p>La mia attività è nata da mio padre “Nitto”. Una leggenda per Catania.<br>
          Tutto ebbe inizio nel 1960, dove mio padre con la sua Ape vendeva il pesce per strada. Da lì ebbe <br>l’occasione di affittarsi una bottega sul lungo mare da Ognina.
        </p>
        <div id ="tasti">
          <a class="tasto1" href="chisiamo.php">Scopri di più</a>
          <a class="tasto2" href="prenotazioni.php">Contattaci  > </a>
        </div> 
      </div>
    </section>
    
    <section id="paragrafo2">
      <div class="grigio"></div>
      <div class="titolo">
        <h2>I nostri servizi</h2>
        <p class="sottotesto">DI COSA CI OCCUPIAMO</p>        
      </div>
      
      <div id = "post_container">            
        <article class="post"> 
          <img src="immagini/IMG-20231203-WA0003-400x250.jpg">
          <h4>Pescheria</h4>
          <p class ="post_content" data-sezione = "Pescheria">Scopri di più</p>          
        </article>
       
        <article class="post">
          <img src="immagini/IMG-20231203-WA0001-1-400x250.jpg">
          <h4>Street Food</h4>
          <p class ="post_content" data-sezione = "StreetFood">Scopri di più</p>
        </article>

        <article class="post">
          <img src="immagini/IMG-20231203-WA0005-1-400x250.jpg">
          <h4>Aperifish</h4>              
          <p class="post_content" data-sezione = "Aperifish">Scopri di più</p>
        </article>       
      </div>
    </section> 

    <section id="paragrafo3">
      <div class="gallery">
        <h2>Gallery</h2>
      </div>
      <div id="galleria">
        <section id="galleria-items"></section>
        <section id = "modal-view" class = "hidden"></section>
      </div>  
    </section>

    <section id="paragrafo4">      
      <div class="sfondo">
        <img src="immagini/IMG_20231203-WA0005-736x623.png">
      </div>
      <div class="sfondo">          
        <div class="padd">
          <p>– L E&nbsp&nbspS P E C I A L I T À</p>
          <h2 class="scritte-menu">Il nostro menù</h2>
          <p class="scarica">Scarica il menù tramite i pulsanti di seguito.</p>
          <div id ="menu">              
            <a class ="tasto1" href="https://www.nittopescheria.it/wp-content/uploads/2023/11/A5-Volantino-ITALIANO_Nitto.pdf">Menù italiano</a>
            <a class="tasto2" href="https://www.nittopescheria.it/wp-content/uploads/2023/11/A5-Volantino_Nitto_ENG.pdf&quot;">Menù inglese</a>
          </div>
        </div>
      </div>
    </section> 

    <section id="sconto">
      <div class = "genera">
        <div>
          <p>Genera il tuo codice sconto cliccando sul seguente tasto</p>
          <button id = "button">Genera!</button>
        </div>
        <div>
          <p class = "bbb">Il tuo codice sconto è:<br><span id="codiceSconto"></span></p>
        </div>
      </div>        
      <div class="overlay"></div>
    </section>

    <section id="domicilio">
        <div class="consegna">
          <h2 class="scrtt">Consegna a domicilio</h2>
          <div class="tel">
            <img src="immagini/kisspng-font-awesome-telephone-call-web-typography-tamworth-precast-concrete-products-tamworth-nsw-23-5d3af0b5cb76a4.8043615515641437978334.png">
            <p class = "scritta">Per informazioni e prenotazioni chiamaci al <span>095491165</span></p>
          </div> 
          <a class="tasto5" href="prenotazioni.php">Oppure vai al form</a>
        </div>
        <img src="immagini/AdobeStock_603490053_1.png" class = "photo">
    </section>

    <section class="social">
      <div class = "media">
        <h2>Seguici sui social</h2>
        <a href = "https://www.facebook.com/Oasifruttidimare/"><img src="immagini/facebook-icon-white-png.png" class="logo"></a>
        <a href = "https://www.instagram.com/oasi_frutti_di_mare_da_nitto/"><img src="immagini/logo-ig-lighting-and-furniture-design-studio-aqua-creations-32.png" class="logo"></a>
      </div>
    </section>

    <section id="paragrafo5">   
      <div class="values">
        <h2>Dicono di noi</h2>
        <div id="results"></div>
      </div> 

      <form id="reviewForm" name="reviewForm" method="post">
        <label>Lascia la tua recensione!</label> 
        <textarea id="addComment" name="recensione" placeholder = 'Scrivi qui...' required></textarea>
        <div class="rating">
          <img src="immagini/stellavuota.png" id="star5" data-value="1" />
          <img src="immagini/stellavuota.png" id="star4" data-value="2" />
          <img src="immagini/stellavuota.png" id="star3" data-value="3" />
          <img src="immagini/stellavuota.png" id="star2" data-value="4" />
          <img src="immagini/stellavuota.png" id="star1" data-value="5" />
        </div>
        <input type="submit" value="Invia">
      </form>
      <p id = "messaggioConferma" class ="hidden">Recensione inviata con successo!</p>

    </section>

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