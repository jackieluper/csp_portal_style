<?php

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
$authObj = new AccessTokenAuthentication();
//Get the Access token.
$accessToken = $authObj->getTokens($grantType, $resource, $clientID, $clientSecret, $authUrl);

class AccessTokenAuthentication {

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
          $_SESSION['azureToken'] = $objResponse->access_token;
        } catch (Exception $e) {
            echo "Exception-" . $e->getMessage();
        }
    }

}