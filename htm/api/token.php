<?php

$clientID = "c9d95c0e-8d97-4bba-b3a1-05bad83f7300";
//Client Secret key of the application.
$clientSecret = "rW2Mvtwa2Pkc0Bt2iI43eHDNoZmDwOsvhUE5hapsGlM=";
//OAuth Url.
$authUrl = "https://login.microsoftonline.com/manFagedsolutioncsptesting.onmicrosoft.com";
//Application Scope Url
$resource = "https://graph.windows.net";
//Application grant type
$grantType = "client_credentials";
//Create the AccessTokenAuthentication object.
$authObj = new AccessTokenAuthentication();
//Get the Access token.
$accessToken = $authObj->getTokens($grantType, $resource, $clientID, $clientSecret, $authUrl);
//Create the authorization Header string.
$authHeader = "Authorization: Bearer " . $accessToken;

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
            $paramArr = http_build_query($paramArr);
            //Set the Curl URL.
            curl_setopt($ch, CURLOPT_URL, $authUrl);
            //Set HTTP POST Request.
            curl_setopt($ch, CURLOPT_POST, TRUE);
            //Set data to POST in HTTP "POST" Operation.
            curl_setopt($ch, CURLOPT_POSTFIELDS, $paramArr);
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
            var_dump(json_decode($objResponse));
            if ($objResponse->error) {
                throw new Exception($objResponse->error_description);
            }
            print_r($objResponse->access_token);
?>
