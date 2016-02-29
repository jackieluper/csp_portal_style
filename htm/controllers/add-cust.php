<?php

session_start();
include('../api/sa-token.php');

$token = $_SESSION['sa_token'];

$companyName = $_SESSION['companyName'] = $_POST['companyName'];
$businessType = $_SESSION['businessType'] = $_POST['businessType'];
$domainName = $_SESSION['domainName'] = $_POST['domainName'];
$address1 = $_SESSION['address1'] = $_POST['address1'];
$pass = $_POST['password'];
$city = $_SESSION['city'] = $_POST['city'];
$address2 = $_SESSION['address2'] = $_POST['address2'];
$country = $_SESSION['country'] = $_POST['country'];
$zip = $_SESSION['zip'] = $_POST['zip'];
$state = $_SESSION['state'] = $_POST['state'];
$fname = $_SESSION['fname'] = $_POST['fname'];
$lname = $_SESSION['lname'] = $_POST['lname'];
$delegation = $_SESSION['delegation'] = $_POST['delegation'];
$email = $_SESSION['email'] = $_POST['email'];
$phone = $_SESSION['phone'] = $_POST['phoneNum'];
//Initialize the Curl Session.
try {
    
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


    $guid = getGUID();
    $guidCor = getGUID();
    $header[] = "Accept: application/json";
    $header[] = 'api-version : 2015-03-31';
    $header[] = "Authorization: Bearer $token";
    $header[] = "x-ms-correlation-id $guidCor";
    $header[] = "x-ms-tracking-id ()$guid ";
    
    $cust = curl_init();
//TODO: I have all form data now need to process it forward to microsoft.
    $paramArr = array(
        "domain_prefix" => $domainName,
        "user_name" => $email,
        "password" => $pass,
        "profile" => array(
            "email" => $email,
            "company_name" => $companyName,
            "culture" => "en-US",
            "language" => "en",
            "default_address" => array(
                "first_name" => $fname,
                "last_name" => $lname,
                "address_line1" => $address1,
                "city" => $city,
                "region" => $state,
                "postal_code" => $zip,
                "country" => "US"
            ),
            "type" => $businessType
        )
    );
    //Create an Http Query.//
    $data = http_build_query($paramArr);
    //Set the Curl URL.
    curl_setopt($cust, CURLOPT_URL, 'https://api.cp.microsoft.com/22e38d40-62cb-47c4-afdf-19421c5522c0/customers/create-reseller-customer');
    curl_setopt($cust, CURLOPT_POST, TRUE);
    curl_setopt($cust, CURLOPT_POSTFIELDS, $data);
    curl_setopt($cust, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($cust, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($cust, CURLOPT_HEADER, $header);
    $strResponse = curl_exec($cust);
    var_dump( $strResponse );
    curl_close($cust);
    //Decode the returned JSON string.
    $custResponse = json_decode($strResponse);

    if ($custResponse->error_code) {
        throw new Exception($custResponse->message);
    }
    echo $custResponse->customer;
    return $custResponse;
} catch (Exception $e) {
    echo "Exception-" . $e->getMessage();
}


