<?php
session_start();
//client id is our app id TODO: NEEDS TO BE CHANGED TO OUR APP ID ON CSP API WHEN WE GO LIVE
$clientID = "c9d95c0e-8d97-4bba-b3a1-05bad83f7300";
//TODO CLIENT SECRET KEY NEEDS TO BE CHANGED AS WELL WHEN WE GO LIVE
//Client Secret key of the application.
$clientSecret = "RqK2qX3TEFfTMrluU3BRQh0lKhgsvbaVqbyZvmax/3g=";
//OAuth Url.
$authUrl = "https://login.microsoftonline.com/managedsolutioncsptesting.onmicrosoft.com";
//Application Scope Url
$resource = "https://graph.windows.net";
//Application grant type
$grantType = "client_credentials";
//Create the AccessTokenAuthentication object.
$request = "grant_type=client_credentials";

$guid = getGUID();

$guidCor = getGUID();
//Get the Access token.
$accessToken = getTokens($grantType, $resource, $clientID, $clientSecret, $authUrl);
//Get the reseller token
$saToken = getResellerToken($accessToken, $request);
//Get the reseller id
$resellerId = getResellerId($saToken, $guid, $guidCor);

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
        if ($curlErrno) {
            $curlError = curl_error($ch);
            throw new Exception($curlError);
        }
        //Close the Curl Session.
        curl_close($ch);
        //Decode the returned JSON string.
        $objResponse = json_decode($strResponse);

        if (isset($objResponse->error)) {
            throw new Exception($objResponse->error_description);
        }
        $accessToken = $objResponse->access_token;
        return $accessToken;
    } catch (Exception $e) {
        echo "Exception-" . $e->getMessage();
    }
}

echo 'AzureToken: ' . $accessToken . '<br>';

function getResellerToken($accessToken, $request) {
    try {


        $header[] = "Accept: application/json";
        $header[] = "ContentType: application/json";
        $header[] = "Authorization: Bearer $accessToken";

        $sa = curl_init(); //set the url, number of POST vars, POST 
        curl_setopt($sa, CURLOPT_URL, 'https://api.cp.microsoft.com/my-org/tokens');
        curl_setopt($sa, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($sa, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($sa, CURLOPT_HTTPHEADER, $header);
        curl_setopt($sa, CURLOPT_POST, 1);
        curl_setopt($sa, CURLOPT_POSTFIELDS, $request);
        $result = curl_exec($sa);
        curl_close($sa);

        if (isset($objResponse->error)) {
            throw new Exception($objResponse->error_description);
        }
        $objResponse = json_decode($result);
        $saToken = $objResponse->access_token;
        $_SESSION['sa_token'] = $saToken;
        return $saToken;
    } catch (Exception $e) {
        echo "Exception-" . $e->getMessage();
    }
}

echo 'Reseller Token: ' . $saToken . '<br>' . '<br>';

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

function getResellerId($saToken, $guid, $guidCor) {
    try {

        $header[] = "Accept: application/json";
        $header[] = "api-version : 2015-03-31";
        $header[] = "Authorization : Bearer $saToken";
        $header[] = "x-ms-correlation-id $guidCor";
        $header[] = "x-ms-tracking-id : $guid";

        //Initialize the Curl Session.
        $rs = curl_init();
        curl_setopt($rs, CURLOPT_URL, "https://api.cp.microsoft.com/customers/get-by-identity?provider=AAD&type=tenant&tid=22e38d40-62cb-47c4-afdf-19421c5522c0");
        curl_setopt($rs, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($rs, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($rs, CURLOPT_HTTPHEADER, $header);
        $objResponse = curl_exec($rs);
        curl_close($rs);
        if (isset($objResponse->error)) {
            throw new Exception($objResponse->error_description);
        }
        $objResponse = json_decode($objResponse);
        $resellerId = $objResponse->id;
        $_SESSION['resellerId'] = $resellerId;
        return $resellerId;
    } catch (Exception $e) {
        echo "Exception-" . $e->getMessage();
    }
}

echo 'Reseller ID: ' . $resellerId . '<br>';
if (isset($resellerId)) {
    header('Location: ../portal/login_page.htm');
}
