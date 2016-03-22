<!--
Author: Jason B. Smith
Date: 2/29/16
Managed Solution
-->
<?php
session_start();
//Setting session variables to variable
$saToken = $_SESSION['sa_token'];
$resellerId = $_SESSION['resellerId'];
//Get new GUID for tracking ID
$guid = getGUID();
//Get new Guid for correlation ID
$guidCor = getGUID();

createCust($saToken, $resellerId, $guid, $guidCor);

//Function creating new GUIDS
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

//Function creating net new customers
function createCust($saToken, $resellerId, $guid, $guidCor) {

    try {
        //Getting information from new user, setting it to a session variable, and variable
        $companyName = $_POST['companyName'] . '<br>';
        $businessType = $_POST['businessType'];
        $domainName = $_POST['domainName'];
        $address1 = $_POST['address1'];
        $pass = $_POST['password'];
        $city = $_POST['city'];
        $address2 = $_POST['address2'];
        $country = $_POST['country'];
        $zip = $_POST['zip'];
        $state = substr($_POST['state'], 0, 2);
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $delegation = $_POST['delegation'];
        $email = $_POST['email'];
        $phone = $_POST['phoneNum'];

        //Setting header for creating new cust as per API
        $header[] = "api-version: 2015-03-31";
        $header[] = "Content-Type: application/json";
        $header[] = "Accept: application/json";     
        $header[] = "Authorization: Bearer $saToken";
        $header[] = "x-ms-correlation-id $guidCor";
        $header[] = "x-ms-tracking-id: $guid";

        //Setting up customer profile to be posted to Microsoft 
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
                    "country" => $country
                ),
                "type" => "organization"
            )
        );
        //Encoding to json string for post
        $data = json_encode($paramArr);
        $cust = curl_init();
        curl_setopt($cust, CURLOPT_URL, "https://api.cp.microsoft.com/$resellerId/customers/create-reseller-customer");
        curl_setopt($cust, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cust, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($cust, CURLOPT_POST, 1);
        curl_setopt($cust, CURLOPT_POSTFIELDS, $data);
        curl_setopt($cust, CURLOPT_HTTPHEADER, $header);
        $strResponse = curl_exec($cust);
        curl_close($cust);
        //Decoding json string
        $custResponse = json_decode($strResponse);
        var_dump($custResponse);
        //Checking for errors on response
        if ($custResponse->error_code) {
            throw new Exception($custResponse->message);
        }
        return $custResponse;
    } catch (Exception $e) {
        echo "Exception-" . $e->getMessage();
    }
}
