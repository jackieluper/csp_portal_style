<?php

session_start();
include 'sa-token.php';
$token = $_SESSION['sa_token'];
echo 'Azure Token: ' . $_SESSION['azureToken'] . '<br>';
echo 'SA Token: ' . $_SESSION['sa_token'] . '<br>';
function getGUID() {

    mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
    $charid = strtoupper(md5(uniqid(rand(), true)));
    $hyphen = chr(45); // "-"
    $uuid = substr($charid, 0, 8) . $hyphen
            . substr($charid, 8, 4) . $hyphen
            . substr($charid, 12, 4) . $hyphen
            . substr($charid, 16, 4) . $hyphen
            . substr($charid, 20, 12);

    return $uuid;
}

try {

    $guid = getGUID();
    $guidCor = getGUID();
    $header = array();
    $header[] = "api-version : 2015-03-31";
    $header[] = "Authorization : Bearer $token";
    $header[] = "Content-Type: application/x-www-form-urlencoded";
    $header[] = "Accept: application/json";
    $header[] = "x-ms-correlation-id $guidCor";
    $header[] = "x-ms-tracking-id : $guid";


    //Initialize the Curl Session.
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.cp.microsoft.com/customers/get-by-identity?provider=AAD&type=tenant&tid=22e38d40-62cb-47c4-afdf-19421c5522c0");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, $header);
    $strResponse = curl_exec($ch);
    echo curl_error($ch) . '<br>';
    curl_close($ch);
    $objResponse = json_decode($strResponse);
    echo 'ID: ' . $objResponse->id;
} catch (Exception $e) {
    echo "Exception-" . $e->getMessage();
}