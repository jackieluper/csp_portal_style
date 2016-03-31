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




$customer = new Customer();

// optional params: billingCulture, billingLanguage, billingAddressCountry, billingAddressRegion
$customer->
        setCompanyDomain($_POST['domainName'])->
        setCompanyName($_POST['companyName'])->
        setBillingFirstName($_POST['fname'])->
        setBillingLastName($_POST['lname'])->
        setBillingEmail($_POST['email'])->
        setBillingCompanyName($_POST['companyName'])->
        setBillingAddressCity($_POST['city'])->
        setBillingAddressState(substr($_POST['state'], 0, 2))->
        setBillingAddressAddressLine1($_POST['address1'])->
        setBillingAddressAddressLine2($_POST['address2'])->
        setBillingAddressPostalCode($_POST['zip'])->
        setBillingAddressFirstName($_POST['fname'])->
        setBillingAddressLastName($_POST['lname'])->
        setBillingAddressPhoneNumber($_POST['phoneNum'])->
        setUsername($_POST['username'])->
        setPassword($_POST['password']);
$customer->createCustomer();
var_dump($customer);
$tid = $customer->getCompanyTenantId();
$userName = $customer->getUsername();
$email = $customer->getBillingEmail();
$id = $customer->getBillingId();
echo $tid . '<br>';
echo $userName . '<br>';
echo $email . '<br>';
echo $id . '<br>';
$sql = "INSERT INTO user set username='$userName', customer_id='123456', email='$email', role='10', azure_id='', tid='$tid'";
if ($conn->query($sql) == TRUE) {
   // header("Location: ../portal/login_page.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}