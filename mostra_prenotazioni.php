<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        echo json_encode(array("status" => "error", "message" => "Non autenticato"));
        exit;
    }
    
    $conn = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_error($conn));
    
    $username = $_SESSION['username'];
    $query = "SELECT nome, cognome, data, ora, info FROM prenotazioni WHERE username = '$username'";
    
    $res = mysqli_query($conn, $query);
    
    if (!$res) {
        echo json_encode(array('ok' => false, 'message' => 'Errore nella query'));
        exit;
    }
    
    $piattiArray = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $piattiArray[] = $row;
    }
    
    echo json_encode($piattiArray);
    mysqli_close($conn);
?>