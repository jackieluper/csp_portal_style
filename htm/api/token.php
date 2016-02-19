<?php

$domain = 'managedsolutioncsptesting.onmicrosoft.com';
$authString = "https://login.microsoftonline.com/" . $domain;
$clientId = 'c9d95c0e-8d97-4bba-b3a1-05bad83f7300';
$key = 'rW2Mvtwa2Pkc0Bt2iI43eHDNoZmDwOsvhUE5hapsGlM=';
$clientCred = $clientId . $key;
$resource = 'https://graph.windows.net';
$token;

/*
$stCurl = curl_init();
curl_setopt($stCurl, CURLOPT_URL, 'https://login.windows.net/managedsolutioncsptesting.onmicrosoft.com/oauth2/token?api-version=1.0');
curl_setopt($stCurl, CURLOPT_PORT, 443);
curl_setopt($stCurl, CURLOPT_VERBOSE, 0);
curl_setopt($stCurl, CURLOPT_HEADER, 0);
curl_setopt($stCurl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($stCurl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($stCurl, CURLOPT_RETURNTRANSFER, 1);

$checkCurl = curl_exec($stCurl);
if (!curl_errno($stCurl)) {
    $info = curl_getinfo($stCurl);
    echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'];
} else {
    echo 'Curl error: ' . curl_error($stCurl);
}

curl_close($stCurl);
print_r($stCurl);
 */
 
$data = array(
    'grant_type' => $clientCred, $resource,
    'client_id' => $clientId,
    'client_secret' => $key
);
 
$tuCurl = curl_init();
curl_setopt($tuCurl, CURLOPT_URL, 'https://login.windows.net/managedsolutioncsptesting.onmicrosoft.com/oauth2/token?api-version=1.0 HTTP/1.1');
curl_setopt($tuCurl, CURLOPT_PORT, 443);
curl_setopt($tuCurl, CURLOPT_VERBOSE, 0);
curl_setopt($tuCurl, CURLOPT_HEADER, 0);
curl_setopt($tuCurl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($tuCurl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($tuCurl, CURLOPT_POST, 1);
curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($tuCurl, CURLOPT_POSTFIELDS, $data);
curl_setopt($tuCurl, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-length: " . sizeof($data)));

$token = curl_exec($tuCurl);
if (!curl_errno($tuCurl)) {
    $info = curl_getinfo($tuCurl);
    echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url'];
} else {
    echo 'Curl error: ' . curl_error($tuCurl);
}

curl_close($tuCurl);
print_r($token);
?> 