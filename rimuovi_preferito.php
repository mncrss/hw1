<?php

    include 'auth.php';
    if (!$username = checkAuth()) {
        echo json_encode(array('ok' => false, 'error' => 'Utente non autenticato'));
    exit;
    }

    prefe();
   
    function prefe() {
        global $username;
    
        $conn = mysqli_connect('localhost', 'root', '', 'hw1');
        if (!$conn) {
            echo json_encode(array('ok' => false, 'error' => 'Errore di connessione al database'));
            exit;
        }
        
        $username = mysqli_real_escape_string($conn, $_SESSION['username']);
        $piatto_id = mysqli_real_escape_string($conn, $_POST['piatto_id']);
        $nome = mysqli_real_escape_string($conn, $_POST['nome_piatto']);
        $immagine = mysqli_real_escape_string($conn, $_POST['img_url']);
        $descrizione = mysqli_real_escape_string($conn, $_POST['descrizione']);
        $prezzo = mysqli_real_escape_string($conn, $_POST['prezzo']);
    
        $query = "SELECT * FROM preferiti WHERE username = '$username' AND piatto_id = '$piatto_id'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if(mysqli_num_rows($res) > 0) {
            $query = "DELETE FROM preferiti WHERE username = '$username' AND piatto_id = '$piatto_id'";
            if(mysqli_query($conn, $query) or die(mysqli_error($conn))) {
                echo json_encode(array('ok' => true, 'piatto_id' => $piatto_id));
                exit;
            }
        }
        
        mysqli_close($conn);
        error_log("Chiusura connessione");
    }
?>