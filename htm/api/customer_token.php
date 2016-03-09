<!--
Author: Jason B. Smith
Date: 2/09/16
Managed Solution
-->
<?php
session_start();
require '../controllers/config.php';
//Set SA Token as token
$token = $_SESSION['sa_token'];
//$request is set as per API
$request = "grant_type=client_credentials";

try {
    //Headers for the Customer Token as per API
    $header[] = "Accept: application/json";
    $header[] = "ContentType: application/json";
    $header[] = "Authorization: Bearer $token";
    //CURL request as per API
    $sa = curl_init(); //set the url, number of POST vars, POST 
    curl_setopt($sa, CURLOPT_URL, 'https://api.cp.microsoft.com/my-org/tokens');
    curl_setopt($sa, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($sa, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($sa, CURLOPT_HTTPHEADER, $header);
    curl_setopt($sa, CURLOPT_POST, 1);
    curl_setopt($sa, CURLOPT_POSTFIELDS, $request);
    //Gets the results 
    $result = curl_exec($sa);
    //Closes the CURL Session
    curl_close($sa);
    //Decodes the json responce
    $objResponse = json_decode($result);
    //Sets another session token for customer
    $_SESSION['customerToken'] = $objResponse->access_token;
  //Catch exceptions and print them out to a meaningful message
} catch (Exception $e) {
    echo "Exception-" . $e->getMessage();
}