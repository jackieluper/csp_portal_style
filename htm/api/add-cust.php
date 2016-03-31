<!--
Author: Jason B. Smith
Date: 2/29/16
Managed Solution
-->
<?php
session_start();
require '../controllers/config.php';
require_once '../api/client/_init.php';
//Setting session variables to variable
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



$customer = new Customer();

// optional params: billingCulture, billingLanguage, billingAddressCountry, billingAddressRegion
$customer->
        setCompanyDomain($domainName)->
        setCompanyName($companyName)->
        setBillingFirstName($fname)->
        setBillingLastName($lname)->
        setBillingEmail($email)->
        setBillingCompanyName($companyName)->
        setBillingAddressCity($city)->
        setBillingAddressState($state)->
        setBillingAddressAddressLine1($address1)->
        setBillingAddressAddressLine2($address2)->
        setBillingAddressPostalCode($zip)->
        setBillingAddressFirstName($fname)->
        setBillingAddressLastName($lname)->
        setBillingAddressPhoneNumber($phone)->
        setUsername($username)->
        setPassword($pass);

$customer->createCustomer();
/*
$sql = "INSERT INTO user set username='$customer->toArray()->', customer_id='Something', email='$this->_billingEmail', role='10', azure_id='$this->_commerceId', tid='$this->_companyTenantId'";
if ($conn->query($sql) == TRUE) {
    header("Location: ../../../portal/products.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}*/