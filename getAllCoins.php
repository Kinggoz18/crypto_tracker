<?php
/*ALTERNATE TO $.ajax() To avoid cross-orgin error */
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    $options = array(
        'http'=>array(
          'method'=>"GET",
          'header'=>"X-CMC_PRO_API_KEY: 5bc8691d-377f-4a2c-833a-e40a00088cea"));
    $final = $_GET['url'];
    $context = stream_context_create($options);
    $response = file_get_contents($final,false,$context);
    //$response = json_decode($response);
    echo $response;
?>