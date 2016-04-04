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
        setUsername("")->
        setPassword("");
$customer->createCustomer();
var_dump($customer);
$userName = 'admin@' . $customer->getCompanyDomain();
$commerce_id = $customer->getCommerceId();
$email = $customer->getBillingEmail();
$tid = $customer->getCompanyTenantId();
$companyName = $customer->getCompanyName();
$entity = $_POST['businessType'];
$billing_id = $customer->getBillingId();
$primary_domain = $customer->getCompanyDomain();
$_SESSION['username'] = $userName;
$_SESSION['pwd'] = $customer->getPassword();


$sql2 = "INSERT INTO customer set customer_name='$companyName', entity_type='$entity', billing_id='$billing_id', company_tid='$tid', is_provised='0', primary_domain='$primary_domain', relationship='Cloud Reseller', discount='0', active='1'";
if ($conn->query($sql2) == True) {
    $sqlCompanyName = "Select id from customer where customer_name='$companyName'";
    $results = $conn->query($sqlCompanyName);
    while ($row = $results->fetch_assoc()) {
        $company_id = $row['id'];
    }
    $sql1 = "Select * from user where username='$userName'";
    $results = $conn->query($sql1);
    if ($results->num_rows > 0) {
        echo "User already exists";
    } else {
        $sql = "INSERT INTO user set username='$userName', customer_id='$company_id', commerce_id='$commerce_id', email='$email', role='10', tid='$tid'";
        if ($conn->query($sql) == TRUE) {
            header("Location: ../portal/regSuccess.phtml");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
}
  