<?php
/*ALTERNATE TO $.ajax() To avoid cross-orgin error */
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    $final = $_GET['url'];
    $response = file_get_contents($final);
    //$response = json_decode($response);
    echo $response;
?>