<?php
session_start();

$saToken = $_SESSION['sa_token'];

$resellerId = $_SESSION['resellerId'];

$guid = getGUID();

$guidCor = getGUID();

createCust($saToken, $resellerId, $guid, $guidCor);

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

function createCust($saToken, $resellerId, $guid, $guidCor) {

    try {
        $companyName = $_SESSION['companyName'] = $_POST['companyName'] . '<br>';
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

        $header[] = "Accept: application/json";
        $header[] = "api-version: 2015-03-31";
        $header[] = "Content-Type: application/json";
        $header[] = "Authorization: Bearer $saToken";
        $header[] = "x-ms-correlation-id $guidCor";
        $header[] = "x-ms-tracking-id: $guid";

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
                    "region" => "CA",
                    "postal_code" => $zip,
                    "country" => "US"
                ),
                "type"=>"organization"
            )
        );

        $data = json_encode($paramArr);
        $cust = curl_init();
        curl_setopt($cust, CURLOPT_URL, "https://api.cp.microsoft.com/$resellerId/customers/create-reseller-customer");
        curl_setopt($cust, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cust, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($cust, CURLOPT_POST, true);
        curl_setopt($cust, CURLOPT_POSTFIELDS, $data);
        curl_setopt($cust, CURLOPT_HTTPHEADER, $header);
        $strResponse = curl_exec($cust);
        curl_close($cust);
        
        $custResponse = json_decode($strResponse);
        var_dump($custResponse);
        if ($custResponse->error_code) {
            throw new Exception($custResponse->message);
        }
        return $custResponse;
    } catch (Exception $e) {
        echo "Exception-" . $e->getMessage();
    }
}
