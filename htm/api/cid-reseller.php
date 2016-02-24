<?php
session_start();
require('token.php');

//Get a reseller ID 
$provider = "AAD";

$type = "tenant";
//tenant ID for reseller/Managed Soultion's ID
$tid = "22e38d40-62cb-47c4-afdf-19421c5522c0";

$token = $_SESSION['token'];

//Create the authorization Header string.
$authHeader = "Authorization: Bearer " . $token;

        try {
            //Initialize the Curl Session.
            $ch = curl_init();
            //Create the request Array.
            $paramArr = array(
                'provider' => $provider,
                'type' => $type,
                'tid' => $tid
            );
            //Create an Http Query.//
            $data = http_build_query($paramArr);
            //Set the Curl URL.
            curl_setopt($ch, CURLOPT_URL, 'https://api.cp.microsoft.com/customers/get-by-identity');
            //CURLOPT_RETURNTRANSFER- TRUE to return the transfer as a string of the return value of curl_exec().
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            //CURLOPT_SSL_VERIFYPEER- Set FALSE to stop cURL from verifying the peer's certificate.
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
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
            $ridResponse = json_decode($strResponse);
            
            if($ridResponse->error_code) {
                throw new Exception($ridResponse->message . $ridResponse->error_code );
            }
            echo 'ID: ' . $ridResponse->id;
            return $ridResponse;
        } catch (Exception $e) {
            echo "Exception-" . $e->getMessage();
        }