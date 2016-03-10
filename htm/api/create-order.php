<?php
session_start();
require '../controllers/config.php';
//Setting session variables to variable
$saToken = $_SESSION['sa_token'];
$resellerId = $_SESSION['resellerId'];
//Get new GUID for tracking ID
$guid = getGUID();
//Get new Guid for correlation ID
$guidCor = getGUID();
//Set line item num
$lineItem = -1;

createOrder($saToken, $resellerId, $guid, $guidCor);

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

function createOrder($saToken, $guid, $guidCor) {

    try {

        //Setting header for creating new cust as per API
        $header[] = "Accept: application/json";
        $header[] = "api-version: 2015-03-31";
        $header[] = "Content-Type: application/json";
        $header[] = "Authorization: Bearer $saToken";
        $header[] = "x-ms-correlation-id $guidCor";
        $header[] = "x-ms-tracking-id: $guid";

        //Getting information from cart for order
        $sql = "SELECT offer_uri, qty FROM cart";
        $result = $conn->query($sql);
        //Setting up customer profile to be posted to Microsoft 
        if ($result->num_rows > 0) {
            //IS THIS THE RIGHT WAY TO PASS THE INFORMATION
            while ($row = $result->fetch_assoc()) {
                $offerUri = $row['offer_uri'];
                $qty = $row['qty'];
                $lineItem = $lineItem + 1;
                
                $paramArr = array(
                    "line_item" => array(
                        "line_item_number" => $lineItem,
                        "offer_uri" => $offerUri,
                        "quantity" => $qty,
                        //DO WE NEED THIS
                        "advisor_partner_id" => "",                      
                    ),
                    //NOT SURE WHAT THIS IS
                    "recipient_customer_id" => ""
                );
            }
            
        }
        //Encoding to json string for post
        $data = json_encode($paramArr);
        $cust = curl_init();
        curl_setopt($cust, CURLOPT_URL, "https://api.cp.microsoft.com/$resellerId/orders");
        curl_setopt($cust, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cust, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($cust, CURLOPT_POST, true);
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