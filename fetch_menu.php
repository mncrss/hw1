<?php 
    include 'auth.php';
    if (!$username = checkAuth()) exit;

    header('Content-Type: application/json');

    $conn = mysqli_connect('localhost', 'root', '', 'hw1');

    $userid = mysqli_real_escape_string($conn, $username);
    
    $query = "SELECT * FROM piatti";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    $piattiArray = array();
    while($row = mysqli_fetch_assoc($res)) {
        $piattiArray[] =$row;
    }
    echo json_encode($piattiArray);
    
    exit;
?>