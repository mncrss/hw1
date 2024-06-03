<?php
  include 'auth.php';
  if (checkAuth()) {
      header('Location: index.php');
      exit;
  }
  
  if(!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["name"]) && !empty($_POST["surname"]) && !empty($_POST["email"]) /*&& !empty($_FILES["img"]["name"])*/)
   { 
     $error= array();
     $conn = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_error($conn));
     if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
      $error[] = "Username non valido";
    } else {
      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $query = "SELECT username FROM users WHERE username = '$username'";
      $res = mysqli_query($conn, $query);
      if (mysqli_num_rows($res) > 0) {
          $error[] = "Username già utilizzato";
      }
    }

    if (strlen($_POST["password"]) < 8) {
      $error[] = "Caratteri password insufficienti";
    } 

    if (strcmp($_POST["password"], $_POST["confirm_password"]) != 0) {
      $error[] = "Le password non coincidono";
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $error[] = "Email non valida";
    } else {
      $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
      $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
      if (mysqli_num_rows($res) > 0) {
          $error[] = "Email già utilizzata";
      }
    }
    
    $img_path = 'immagini/default.png';

    if (!empty($_FILES["img"]["name"])) {
    do {
      if ($_FILES["img"]["error"] !== UPLOAD_ERR_OK) {
        $error[] = "Errore nel caricamento del file";
        break;
      }
      
      if ($_FILES['img']['size'] > 1048576) {
        $error[] = "Il file non deve superare 1MB!!";
        break;
      }
  
      list(/*$width, $height, */$type, $attr) = getimagesize($_FILES['img']['tmp_name']);
  
      if (($type != IMAGETYPE_JPEG) && ($type != IMAGETYPE_PNG)) {
        $error[] = "Formato non corretto!!";
        break;
      }
  
      $img_path = 'immagini/' . basename($_FILES["img"]["name"]);
      if (file_exists($img_path)) {
        $error[] = "File già esistente sul server. Rinominarlo e riprovare.";
        break;
      }
  
      if (!move_uploaded_file($_FILES['img']['tmp_name'], $img_path)) {
        $error[] = "Errore nel caricamento dell'immagine!!";
        break;
      }
    } while (false);
  }
  
    if (count($error) == 0) {
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $surname = mysqli_real_escape_string($conn, $_POST['surname']);

      $password = mysqli_real_escape_string($conn, $_POST['password']);
      $password = password_hash($password, PASSWORD_BCRYPT);


      $query="INSERT INTO users (immagine, username, password, email, name, surname) VALUES('$img_path', '$username','$password','$email','$name','$surname')";
      if (mysqli_query($conn, $query)) {
        $_SESSION["_agora_username"] = $_POST["username"];
        $_SESSION["_agora_user_id"] = mysqli_insert_id($conn);
        mysqli_close($conn);
        header("Location: homepage.php");
        exit;
      } else {
        $error[] = "Errore di connessione al Database";
      }
    }

    mysqli_close($conn);
  }
  else if (isset($_POST["username"])) {
    $error = array("Riempi tutti i campi");
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset = "utf-8">
    <title>NITTO</title>
    <link rel="stylesheet" href="registrazione.css" />
    <link href="https://fonts.googleapis.com/css2?family=Elsie+Swash+Caps:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <script src = "registrazione.js" defer></script>
  </head>

  <body>
    <section id = "login">
      <div class = "rrr">  
        <h2>Registrati</h2>
        <p class = "registrazione">Hai già un account? <a href="accesso.php">Accedi</a></p>
        <img src = "immagini/logo-header-3.png" id = "logo">
        <div id = "blocco">          
          <form action="" name="iscriviti" method="POST" enctype="multipart/form-data">
            <label>Carica l'immagine profilo<input type="file" id="img" name="img" accept="image/*"></label>

            <div class = "riga">
              <div class="name">
                <label for='name'>Nome</label>
                <input type='text' name='name' <?php if(isset($_POST["name"])){echo "value=".$_POST["name"];} ?>>
              </div>

              <div class="surname">
                <label for='surname'>Cognome</label>
                <input type='text' name='surname' <?php if(isset($_POST["surname"])){echo "value=".$_POST["surname"];} ?>>
              </div>
            </div>  
             
            <div class="riga">
              <div class="username">
                <label for='username'>Nome utente</label>
                <input type='text' name='username' <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
                <div><span></span></div>
              </div>
                
              <div class="email">
                <label for='email'>Email</label>
                <input type='text' name='email' <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>>
                <div><span></span></div>
              </div>
            </div>
            
            <div class="riga">
              <div class="password">
                <label for='password'>Password</label>
                <input type='password' name='password' <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                <div><span></span></div>              
              </div>
                
              <div class="confirm_password">
                <label for='confirm_password'>Conferma Password</label>
                <input type='password' name='confirm_password' <?php if(isset($_POST["confirm_password"])){echo "value=".$_POST["confirm_password"];} ?>>
                <div><span></span></div>
              </div>
            </div>
            
            <?php if(isset($error)) {
                foreach($error as $err) {
                  echo "<div class='errorj'><span>".$err."</span></div>";
                }
              } ?>
            
            <p>
              <label>&nbsp;<input type="submit" name="iscrizione" id="iscrizione" value="Iscriviti"></label>
            </p>
          </form>
        </div>
      </div>
    </section>    
  </body>
</html>
