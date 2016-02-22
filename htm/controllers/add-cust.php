<?php
session_start();
require_once('../api/token.php');


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
echo "company name: " . $companyName . '<br>';
echo "business type: " . $businessType . '<br>';
echo "domain name: " . $domainName . '<br>';
echo "address1 : " . $address1 . '<br>';
echo "password : " . $pass . '<br>';
echo "city : " . $city . '<br>';
echo "address2 : " . $address2 . '<br>';
echo "country : " . $country . '<br>';
echo "zip : " . $zip . '<br>';
echo "state : " . $state . '<br>';
echo "fname : " . $fname . '<br>';
echo "lname : " . $lname . '<br>';
echo "delegation : " . $delegation . '<br>';
echo "email : " . $email . '<br>';
echo "phone : " . $phone . '<br>';
echo 'token : ' . $_SESSION['token'] . '<br>';

//TODO: I have all form data now need to process it forward to microsoft.



