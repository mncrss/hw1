<?php
 include 'auth.php';
  if (checkAuth()) {
      header('Location: index.php');
      exit;
  }
  

  if(!empty($_POST["username"]) && !empty($_POST["password"]))
  {     
     $conn=mysqli_connect("localhost","root","","hw1");
     $username=mysqli_real_escape_string($conn, $_POST["username"]);
     $password=mysqli_real_escape_string($conn, $_POST["password"]);
     $query="SELECT * FROM users WHERE username='$username'";
     $res= mysqli_query($conn, $query) or die(mysqli_error($conn));;
     if(mysqli_num_rows($res)>0)
     {
        $login = mysqli_fetch_assoc($res);
        if (password_verify($_POST['password'], $login['password'])) {
          $_SESSION["username"]=$_POST["username"];
          $_SESSION['log']=$login['id'];
          $_SESSION['immagine'] = $login['immagine'];
          
          header("Location: homepage.php");
          mysqli_free_result($res);
          mysqli_close($conn);
          exit;
        }
        else{
          $error=true;
        }
      }
      else{
        $error=true;
      }   
  }
  
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset = "utf-8">
    <title>NITTO</title>
    <link rel="stylesheet" href="accesso.css" />
    <link href="https://fonts.googleapis.com/css2?family=Elsie+Swash+Caps:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <script src = "accesso.js" defer></script>
  </head>

  <body>
    <section id = "accesso">
      <div>  
        <h2>Accedi al tuo account</h2>
        <p class = "registrazione">Non hai un account? <a href="registrazione.php">Iscriviti ora</a></p>
        <img src = "immagini/logo-header-2.png">
        <div id = "blocco">   
          <?php            
            if(isset($error))
              {
                echo "Credenziali Sbagliate";    
              }
          ?>
          <form action="" name="login" method="POST">
            <p>
              <label>Nome utente<input type="text" name="username"></label>
            </p>
            <p>
              <label>Password<input type="password" name="password" ></label>
            </p>
            <p>
              <label>&nbsp;<input type="submit" name="submit" id="submit" value="Accedi" action="index.php"></label>
            </p>  
          </form>
         </div>
      </div>
    </section>
  </body>
</html>