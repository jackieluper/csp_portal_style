<!--
Author: Jason B. Smith
Date: 2/29/16
Managed Solution
-->
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

createCust($saToken, $resellerId, $guid, $guidCor, $conn);

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
function createCust($saToken, $resellerId, $guid, $guidCor, $conn) {

    try {
//Getting information from new user, setting it to a session variable, and variable
        $companyName = $_POST['companyName'];
        $businessType = $_POST['businessType'];
        $domainName = $_POST['domainName'];
        $address1 = $_POST['address1'];
        $pass = $_POST['password'];
        $username = $_POST['username'];
        $city = $_POST['city'];
        $address2 = $_POST['address2'];
        $country = $_POST['country'];
        $zip = $_POST['zip'];
        $state = substr($_POST['state'], 0, 2);
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $delegation = $_POST['delegation'];
        $email = $_POST['email'];
        $user = $email;
        $phone = $_POST['phoneNum'];

//Setting header for creating new cust as per API
        $header[] = "Authorization: Bearer $saToken";
        $header[] = "Accept: application/json";
        $header[] = "MS-Contract-Version: v1";
        $header[] = "MS-RequestId: $guid";
        $header[] = "MS-CorrelationId: $guidCor";
        $header[] = "Content-Type: application/json";
        $header[] = "Content-Length: 744";


//Setting up customer profile to be posted to Microsoft 
        $paramArr = [
            "CompanyProfile" => [
                "Domain" => $domainName,
                "CompanyName" => $companyName,
            ],
            "BillingProfile" => [
                "Culture" => "EN-US",
                "Language" => "En",
                "FirstName" => $fname,
                "LastName" => $lname,
                "Email" => "$email.onmicrosoft.com",
                "CompanyName" => $companyName,
                "DefaultAddress" => [
                    "FirstName" => $fname,
                    "LastName" => $lname,
                    "AddressLine1" => $address1,
                    "AddressLine2" => $address2,
                    "City" => "Redmond",
                    "State" => "WA",
                    "Country" => "US",
                    "PostalCode" => "98052",
                    "PhoneNumber" => "4255555555"
                ],
            ],
        ];

//Encoding to json string for post
        $data = json_encode($paramArr);
        $cust = curl_init();
        curl_setopt($cust, CURLOPT_URL, "https://api.partnercenter.microsoft.com/v1/customers HTTP/1.1");
        curl_setopt($cust, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cust, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($cust, CURLOPT_POST, true);
        curl_setopt($cust, CURLOPT_POSTFIELDS, $data);
        curl_setopt($cust, CURLOPT_HTTPHEADER, $header);
        $strResponse = curl_exec($cust);
        var_dump($cust);
        curl_close($cust);
//Decoding json string
        $custResponse = json_decode($strResponse);
        var_dump($strResponse);
        if (isset($custResponse->error)) {
            throw new Exception($custResponse->message);
        }
        $azure_id = $custResponse->id;
        $tid = $custResponse->CompanyProfile->TenantId;

        $sqlCust = "select * from customer where customer_name='$companyName'";
        $resultsCust = $conn->query($sqlCust);
        if ($resultsCust->num_rows > 0) {
            echo 'company already exists' . '<br>';
        } else {
            $sql = "INSERT INTO customer (customer_name, entity_type, ms_customer_id, is_provised, primary_domain, relationship, discount, active)
                VALUES('$companyName', '$businessType', '$tid', '0', '$domainName', 'CLOUD RESELLER', '0', '1')" or die(mysql_error());

            if ($conn->query($sql) === TRUE) {
                echo "added customer profile";
            }
        }
        $sqlId = "Select id from customer where customer_name='$companyName'";
        $resultId = $conn->query($sqlId);
        if ($resultId->num_rows > 0) {
            while ($row = $resultId->fetch_assoc()) {
                $customer_id = $row['id'];
            }
            $sqlUser = "select * from user where username='$username'";
            $resultUser = $conn->query($sqlUser);
            if ($resultUser->num_rows > 0) {
                echo 'user profile already exists' . '<br>';
            } else {
                $sql1 = "INSERT into user (username, customer_id, email, role, azure_id, tid)
                     VALUES('$username', '$customer_id', '$email', '10', '$azure_id', '$tid')" or die(mysql_error());
                if ($conn->query($sql1) === TRUE) {
                    echo "added user profile";
                    //header('Location: ../portal/login_page.php');
                } else {
                    echo $conn->error;
                }
            }
        }
    } catch (Exception $e) {
        echo "Exception-" . $e->getMessage();
    }
}
