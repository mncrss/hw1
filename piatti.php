<?php
    $conn = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_error($conn));

    $tipologia = isset($_GET['tipologia']) ? mysqli_real_escape_string($conn, $_GET['tipologia']) : '';

    $sql = "SELECT id, nome, descrizione, img_url, tipologia, prezzo FROM piatti WHERE tipologia LIKE '%$tipologia%'";

    $result = mysqli_query($conn, $sql);

    $data = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    } 

    header('Content-Type: application/json');
    echo json_encode($data);

    mysqli_close($conn);
?>
