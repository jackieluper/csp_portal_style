<?php

include 'token.php';

$token = $_SESSION['azureToken'];
$request = "grant_type=client_credentials";
try {


    $header[] = "Accept: application/json";
    $header[] = "ContentType: application/json";
    $header[] = "Authorization: Bearer $token";

    $sa = curl_init(); //set the url, number of POST vars, POST 
    curl_setopt($sa, CURLOPT_URL, 'https://api.cp.microsoft.com/my-org/tokens');
    curl_setopt($sa, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($sa, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($sa, CURLOPT_HTTPHEADER, $header);
    curl_setopt($sa, CURLOPT_POST, 1);
    curl_setopt($sa, CURLOPT_POSTFIELDS, $request);

    $result = curl_exec($sa);
    curl_close($sa);


    $objResponse = json_decode($result);
    $_SESSION['sa_token'] = $objResponse->access_token;
} catch (Exception $e) {
    echo "Exception-" . $e->getMessage();
}