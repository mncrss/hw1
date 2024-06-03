<?php
    $API_KEY = "2d8ba449a5bd41388941e727fd0ac22b"; 
    $query = urlencode($_GET["q"]);
    $endpoint = 'https://api.spoonacular.com/food/wine/recommendation?wine='.$query.'&number=4&apiKey='.$API_KEY;
    
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $endpoint);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    
    echo $result;
?>
