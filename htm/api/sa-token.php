<?php
require 'token.php';
//grab azure ad security token from token.php
$authorization = 'Authorization : Bearer' . $_SESSION['azureToken'];

echo 'Azure Token : ' . $authorization .'<br>';

try {

    //Initialize the Curl Session.
    $sa = curl_init();
    //Set the Curl URL.
    curl_setopt($sa, CURLOPT_URL, 'https://api.cp.microsoft.com/my-org/tokens');
    //Set HTTP POST Request.
    curl_setopt($sa, CURLOPT_POST, TRUE);
    //Set data to POST in HTTP "POST" Operation.
    curl_setopt($sa, CURLOPT_POSTFIELDS, http_build_query(array(
        'grant_type' => 'client_credentials'
    )));
    //CURLOPT_RETURNTRANSFER- TRUE to return the transfer as a string of the return value of curl_exec().
    curl_setopt($sa, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt ($sa, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($sa, CURLOPT_HTTPHEADER, array(
        'Accept:application/x-www-form-urlencoded',
        $authorization
    ));
    //Execute the  cURL session.
    $strResponse = curl_exec($sa);
        //Get the Error Code returned by Curl.
    $curlErrno = curl_errno($sa);
    if ($curlErrno) {
        $curlError = curl_error($sa);
        throw new Exception($curlError);
    }
    curl_close($sa);
    //Close the Curl Session.
    
    //Decode the returned JSON string.
    $objResponse = $strResponse;

    if (isset($objResponse->error_code)) {
        throw new Exception($objResponse->error_code, $objResponse->message, $objResponse->parameters);
    }
    //$_SESSION['saToken'] = $objResponse->access_token;
    //echo 'SA Token: ' . $objResponse->access_token;
    var_dump($objResponse);
    return $objResponse;
} catch (Exception $e) {
    echo "Exception-" . $e->getMessage();
}