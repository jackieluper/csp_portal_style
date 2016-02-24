<?php
session_start();
include('../api/token.php');


$companyName = $_SESSION['companyName'] = $_POST['companyName'];
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
//Initialize the Curl Session.
        try{
            $cust = curl_init();
//TODO: I have all form data now need to process it forward to microsoft.
            $paramArr = array(
                "domain_prefix" => $domainName,
                    "user_name" => $email,
                    "password" => $pass,
                    $profile = array(
                            "email" => $email,
                            "company_name" => $companyName,
                            "culture" => "en-US",
                            "language" => "en",
                            $default_address = array (
                                    "first_name" => $fname,
                                    "last_name" => $lname,
                                    "address_line1" => $address1,
                                    "city" => $city,
                                    "region" => $state,
                                    "postal_code" => $zip,
                                    "country" => "US"
                            ),
                            "type" => $businessType
                    )
            );
            //Create an Http Query.//
            $data = http_build_query($paramArr);
            //Set the Curl URL.
            curl_setopt($cust, CURLOPT_URL, 'https://api.cp.microsoft.com/22e38d40-62cb-47c4-afdf-19421c5522c0/customers/create-reseller-customer');
            //Set HTTP POST Request.
            curl_setopt($cust, CURLOPT_POST, TRUE);
            //Set data to POST in HTTP "POST" Operation.
            curl_setopt($cust, CURLOPT_POSTFIELDS, $data);
            //CURLOPT_RETURNTRANSFER- TRUE to return the transfer as a string of the return value of curl_exec().
            curl_setopt($cust, CURLOPT_RETURNTRANSFER, TRUE);
            //CURLOPT_SSL_VERIFYPEER- Set FALSE to stop cURL from verifying the peer's certificate.
            curl_setopt($cust, CURLOPT_SSL_VERIFYPEER, FALSE);
            //Execute the  cURL session.
            $strResponse = curl_exec($cust);
            //Get the Error Code returned by Curl.
            $curlErrno = curl_errno($cust);
            if ($curlErrno) {
                $curlError = curl_error($cust);
                throw new Exception($curlError);
            }
            //Close the Curl Session.
            curl_close($cust);
            //Decode the returned JSON string.
            $custResponse = json_decode($strResponse);

            if($custResponse->error_code) {
                throw new Exception($custResponse->message);
            }
            echo $custResponse->customer;
            return $custResponse;
        } catch (Exception $e) {
            echo "Exception-" . $e->getMessage();
        }


