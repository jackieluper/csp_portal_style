<?php

$clientID = "1aa67243-0a91-49ca-9689-9880f15172cf";
//Client Secret key of the application.
$clientSecret = "rW2Mvtwa2Pkc0Bt2iI43eHDNoZmDwOsvhUE5hapsGlM=";
//OAuth Url.
$authUrl = "https://login.microsoftonline.com/managedsolutioncsptesting.onmicrosoft.com";
//Application Scope Url
$resource = "https://graph.windows.net";
//Application grant type
$grantType = "client_credentials";
//Create the AccessTokenAuthentication object.
$authObj = new AccessTokenAuthentication();
//Get the Access token.
$accessToken = $authObj->getTokens($grantType, $scopeUrl, $clientID, $clientSecret, $authUrl);
//Create the authorization Header string.
$authHeader = "Authorization: Bearer " . $accessToken;

class AccessTokenAuthentication {

    function getTokens($grantType, $resource, $clientID, $clientSecret, $authUrl) {
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
            curl_setopt($ch, CURLOPT_URL, 'https://login.windows.net/managedsolutioncsptesting.onmicrosoft.com/oauth2/token?api-version=1.0');
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
            echo $objResponse['access-token'];
            
            if ($objResponse->error) {
                throw new Exception($objResponse->error_description);
            }
            return $objResponse->access_token;
            
        } catch (Exception $e) {
            echo "Exception-" . $e->getMessage();
        }
    }

}
