<!--
Author: Jason B. Smith
Date: 2/29/16
Managed Solution
-->
<?php
session_start();
require '../controllers/config.php';
//Application grant type
$grantType = "client_credentials";
//Create the AccessTokenAuthentication object.
$request = "grant_type=client_credentials";
//Get the GUID for tracking ID
$guid = getGUID();
//Get GUID for correlation ID
$guidCor = getGUID();
//Get the Access token.
$accessToken = getTokens($grantType, $resource, $clientID, $clientSecret, $authUrl);
//Get the reseller token
$saToken = getResellerToken($accessToken, $request);
//Get the reseller id
$resellerId = getResellerId($saToken, $guid, $guidCor);

//Function getting Azure Token as per API
function getTokens($grantType, $resource, $clientID, $clientSecret) {
    try {
        //Initialize the Curl Session.
        $ch = curl_init();
        //Create the request Array.
        $paramArr = array(
            'grant_type' => $grantType,
            'resource' => $resource,
            'client_id' => $clientID,
            'client_secret' => $clientSecret
        );
        //Create an Http Query.//
        $data = http_build_query($paramArr);
        //Set the Curl URL.
        curl_setopt($ch, CURLOPT_URL, 'https://login.windows.net/managedsolutioncsptesting.onmicrosoft.com/oauth2/token?api-version=1.6');
        //Set HTTP POST Request.
        curl_setopt($ch, CURLOPT_POST, TRUE);
        //Set data to POST in HTTP "POST" Operation.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //CURLOPT_RETURNTRANSFER- TRUE to return the transfer as a string of the return value of curl_exec().
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //CURLOPT_SSL_VERIFYPEER- Set FALSE to stop cURL from verifying the peer's certificate.
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //Execute the  cURL session.
        $strResponse = curl_exec($ch);
        //Get the Error Code returned by Curl.
        $curlErrno = curl_errno($ch);
        //Close the Curl Session.
        curl_close($ch);
        //Decode the returned JSON string.
        $objResponse = json_decode($strResponse);
        //Looking for errors in the CURL response
        if (isset($objResponse->error)) {
            throw new Exception($objResponse->error_description);
        }
        //Set Azure Token for next step SA Token
        $accessToken = $objResponse->access_token;
        return $accessToken;
    } catch (Exception $e) {
        echo "Exception-" . $e->getMessage();
    }
}
//Function 2 get SA Token after Azure Token as per API
function getResellerToken($accessToken, $request) {
    try {
        //Header set up as per API
        $header[] = "Accept: application/json";
        $header[] = "ContentType: application/json";
        $header[] = "Authorization: Bearer $accessToken";

        $sa = curl_init();
        curl_setopt($sa, CURLOPT_URL, 'https://api.cp.microsoft.com/my-org/tokens');
        curl_setopt($sa, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($sa, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($sa, CURLOPT_HTTPHEADER, $header);
        curl_setopt($sa, CURLOPT_POST, 1);
        curl_setopt($sa, CURLOPT_POSTFIELDS, $request);
        $result = curl_exec($sa);
        curl_close($sa);
        //Checking for errors in response
        if (isset($objResponse->error)) {
            throw new Exception($objResponse->error_description);
        }
        //Decoding json response
        $objResponse = json_decode($result);
        //Setting satoken from response
        $saToken = $objResponse->access_token;
        //Setting session with SA Token for other API
        $_SESSION['sa_token'] = $saToken;
        return $saToken;
    } catch (Exception $e) {
        echo "Exception-" . $e->getMessage();
    }
}
//Function to create new GUID for every new call
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
//Function to get Reseller ID after SA Token
function getResellerId($saToken, $guid, $guidCor) {
    try {
        //Header as per API
        $header[] = "Accept: application/json";
        $header[] = "api-version : 2015-03-31";
        $header[] = "Authorization : Bearer $saToken";
        $header[] = "x-ms-correlation-id $guidCor";
        $header[] = "x-ms-tracking-id : $guid";

        $rs = curl_init();      
        //tid is the company ID/commerce ID both are the same from your companies partner center
        curl_setopt($rs, CURLOPT_URL, "https://api.cp.microsoft.com/customers/get-by-identity?provider=AAD&type=tenant&tid=22e38d40-62cb-47c4-afdf-19421c5522c0");
        curl_setopt($rs, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($rs, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($rs, CURLOPT_HTTPHEADER, $header);
        $objResponse = curl_exec($rs);
        curl_close($rs);
        //Checking for errors in response
        if (isset($objResponse->error)) {
            throw new Exception($objResponse->error_description);
        }
        //Decode json string
        $objResponse = json_decode($objResponse);
        //Set id to Reseller ID
        $resellerId = $objResponse->id;
        //Set session token for later use
        $_SESSION['resellerId'] = $resellerId;
        return $resellerId;
    } catch (Exception $e) {
        echo "Exception-" . $e->getMessage();
    }
}
//If reseller id is succesfully retrieved it redirects to login page
if (isset($resellerId)) {
    header('Location: ../portal/login_page.phtml');
}
//Errors if unable to get reseller id
else{
    echo "Error Retrieving RESELLER ID!";
}
