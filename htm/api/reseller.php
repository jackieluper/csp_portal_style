<?php
session_start();
$token = $_SESSION['sa_token'];

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

    $guid = (string) getGUID();
    $guidCor = (string) getGUID();
    $header = array();
    $header[] = "Accept: application/json";
    $header[] = "api-version : 2015-03-31";
    $header[] = "x-ms-correlation-id $guidCor";
    $header[] = "x-ms-tracking-id : $guid";
    $header[] = "Authorization : Bearer $token";

    //Initialize the Curl Session.
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.cp.microsoft.com/customers/get-by-identity?provider=AAD&type=tenant&tid=22e38d40-62cb-47c4-afdf-19421c5522c0');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, $header);
    $strResponse = curl_exec($ch);
    echo curl_error($ch) . '<br>';
    curl_close($ch);
    $ridResponse = json_decode($strResponse);
    echo 'ID: ' . $ridResponse['id'];
    return $ridResponse;
} catch (Exception $e) {
    echo "Exception-" . $e->getMessage();
}