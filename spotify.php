<?php
header('Content-Type: application/json');

function spotify() {
    $client_id = "6250146e6b5748fe9b91b5b621782d34";
    $client_secret = "085c2a1d074e40fcb3d46780992e5df6";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $headers = array("Authorization: Basic " . base64_encode($client_id . ":" . $client_secret));
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($curl);
    $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($http_status !== 200) {
        echo json_encode(array("error" => "Failed to obtain access token", "response" => $response));
        exit;
    }

    $token = json_decode($response, true)['access_token'];

    if (!$token) {
        echo json_encode(array("error" => "Access token is null", "response" => $response));
        exit;
    }

    $query = urlencode($_GET["q"]);
    $url = 'https://api.spotify.com/v1/shows?ids=' . $query;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $headers = array("Authorization: Bearer " . $token);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $res = curl_exec($curl);
    $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($http_status !== 200) {
        echo json_encode(array("error" => "Failed to fetch data from Spotify API", "response" => $res));
        exit;
    }

    echo $res;
}

spotify();
?>
