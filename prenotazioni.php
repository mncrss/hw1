<?php
session_start();
if(!isset($_SESSION["username"])) {
    header("Location: accesso.php");
    exit;
}

if(!empty($_POST["nome"]) && !empty($_POST["cognome"]) && !empty($_POST["data"]) && !empty($_POST["ora"]) && !empty($_POST["allow"])) { 
    $error = array();
    $conn = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_error($conn));
    
    $username = mysqli_real_escape_string($conn, $_SESSION['username']);
    $nome = mysqli_real_escape_string($conn, $_POST["nome"]);
    $cognome = mysqli_real_escape_string($conn, $_POST["cognome"]);
    $data = mysqli_real_escape_string($conn, $_POST["data"]);
    $ora = mysqli_real_escape_string($conn, $_POST["ora"]);
    $info = mysqli_real_escape_string($conn, $_POST["info"]);
    $query = "INSERT INTO prenotazioni (username, nome, cognome, data, ora, info) VALUES ('$username','$nome', '$cognome', '$data', '$ora', '$info')";

    if (mysqli_query($conn, $query)) {
        $response = array("status" => "success", "message" => "Prenotazione aggiunta con successo.");
    } else {
        $response = array("status" => "error", "message" => "Impossibile aggiungere la prenotazione.");
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
    <meta charset="utf-8">
    <title>NITTO</title>
    <link rel="stylesheet" href="prenotazioni.css" />
    <link href="https://fonts.googleapis.com/css2?family=Elsie+Swash+Caps:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <script src="prenotazioni.js" defer></script>
</head>

<body>
  <nav id="navigazione">
    <img src="immagini/logo-header-1.png"/>
    <div class="info">
        <a href="homepage.php">Home</a>
        <a href="chisiamo.php">Chi Siamo</a>
        <a href="menu.php">Menù</a>
        <a href="prenotazioni.php">Prenota</a>
        <a href = "profile.php">Profilo</a>
        <a href="https://www.facebook.com/Oasifruttidimare/"><img src="immagini/facebook_logo_icon_181322.png"></a>
        <a href="https://www.instagram.com/oasi_frutti_di_mare_da_nitto/"><img src="immagini/Instagram-PNGinstagram-icon-png.png"></a>
    </div>
    <div id="tenda">
        <div id="strisce">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div id="tendina" class="hidden">
            <a href="homepage.php">Home</a>
            <a href="chisiamo.php">Chi Siamo</a>
            <a href="menu.php">Menù</a>
            <a href="prenotazioni.php">Prenota</a>
            <a href = "profile.php">Profilo</a>
            <a href="https://www.facebook.com/Oasifruttidimare/">Facebook</a>
            <a href="https://www.instagram.com/oasi_frutti_di_mare_da_nitto/">Instagram</a>
        </div>
    </div>
  </nav>

  <section>
    <div class="pesce"></div>
    <div id="blocco">
        <div id="bloccosx">
            <div class="necessita">
                <p>PRENOTA IL TUO TAVOLO</p>
                <h3>Prenota tramite il <br>modulo a lato</h3>

                <div class="informazioni">
                    <img src="immagini/maps.png" class="loghi">
                    <div class="testo">
                        <h4>Sede</h4>
                        <p>Piazza Mancini Battaglia n. 2/4/5/6 – 95126 Catania</p>
                    </div>
                </div>

                <div class="informazioni">
                    <img src="immagini/phone.png" class="loghi">
                    <div class="testo">
                        <h4>Cellulare</h4>
                        <p>3473030647 / 3515332632</p>
                    </div>
                </div>

                <div class="informazioni">
                    <img src="immagini/orologio.png" class="loghi">
                    <div class="testo">
                        <h4>I nostri orari</h4>
                        <p>Tutti i giorni: 8:00-23:00</p>
                    </div>
                </div>

                <div class="informazioni">
                    <img src="immagini/email.png" class="loghi">
                    <div class="testo">
                        <h4>Email</h4>
                        <p>oasifruttidimaredanitto@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>

        <form name="bloccodx" id="bloccodx" method="post">
            <div class="riga">
                <input type="text" name="nome" placeholder="Nome*" required>
                <input type="text" name="cognome" placeholder="Cognome*" required>
            </div>

            <div class="riga">
                <input type="date" name="data" required>
                <input type="time" name="ora" required>
            </div>

            <div class="note">
                <textarea name="info" placeholder="Informazioni aggiuntive (es. per quante persone è il tavolo, preferenza all'aperto o al chiuso, reparto ristorante o reparto street food, etc.)"></textarea>
            </div>

            <div class="privacy">
                <p>La scrivente fornisce, di seguito, le informazioni riguardanti l’utilizzo dei dati personali da Lei rilasciati attraverso la compilazione di questo form, in osservanza alle norme di cui al Regolamento UE 2016/679, relativo alla protezione delle persone fisiche con riguardo al trattamento dei dati personali, nonché alla libera circolazione di tali dati (noto anche come GDPR). I dati concernenti la Sua persona, da Lei spontaneamente forniti tramite la compilazione di moduli informatici, vengono raccolti esclusivamente per consentire il contatto con l’azienda e, eventualmente, eseguire il contratto con Lei concluso. Il conferimento, da parte Sua, dei dati in parola ha natura obbligatoria; il suo eventuale rifiuto non ci permetterà di fornirLe il prodotto/servizio da Lei richiesto (potenzialmente esponendoLa a responsabilità per inadempimento contrattuale) e, comunque, di evadere la Sua richiesta. All’interno della nostra struttura potrà venire a conoscenza dei dati solo il personale incaricato di effettuare operazioni di trattamento dei dati stessi, sempre per le citate finalità. Le ricordiamo inoltre che, facendone apposita richiesta al titolare del trattamento, potrà esercitare tutti i diritti previsti dagli articoli da 15 a 22 del predetto Regolamento UE, che Le consentono, in particolare, la facoltà di chiedere l’accesso ai dati personali e di estrarne copia (art. 15 GDPR), la rettifica (art. 16 GDPR) e la cancellazione degli stessi (art. 17 GDPR), la limitazione del trattamento che La riguardi (art. 18 GDPR), la portabilità dei dati (art. 20 GDPR, ove ne ricorrano i presupposti) e di opporsi al trattamento che La riguardi (artt. 21 e 22 GDPR, per le ipotesi ivi menzionate e, in particolare, al trattamento per finalità di marketing o che si traduca in un processo decisionale automatizzato, compresa la profilazione, che produca effetti giuridici che lo riguardano, ove ne ricorrano i presupposti). Le ricordiamo, altresì, il Suo diritto, qualora il trattamento sia basato sul consenso, di revocare detto consenso in qualsiasi momento, senza pregiudicare la liceità del trattamento basata sul consenso prestato prima della revoca; per fare ciò, può disiscriversi in ogni momento contattando il titolare del trattamento ai recapiti pubblicati sul sito stesso. La informiamo, inoltre, del diritto di proporre reclamo all’Autorità Garante per la Protezione dei Dati Personali, quale autorità di controllo operante in Italia, e di proporre ricorso giurisdizionale, tanto avverso una decisione dell’Autorità Garante, quanto nei confronti del titolare del trattamento stesso e/o di un responsabile del trattamento.
                </p>
            </div>

            <p class="condizioni">
                <label for="allow"><input type="checkbox" name="allow" required>*Ho letto e accetto le condizioni della Privacy</label>
            </p>

            <input type="submit" id="prenota" value="PRENOTA">
        </form>
    </div>
  <p id = "messaggioConferma" class ="hidden">La prenotazione è stata aggiunta con successo!</p>
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