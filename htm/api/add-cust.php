<!--
Author: Jason B. Smith
Date: 2/29/16
Managed Solution
-->
<?php
session_start();
require '../controllers/config.php';
require_once '../api/client/_init.php';

//Setting form variables to customer object
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


$newCustStmt = $conn->prepare("INSERT INTO customer set customer_name= ?, entity_type=?, billing_id=?, company_tid=?, is_provised=?, primary_domain=?, relationship=?, discount=?, active=?");
$newCustStmt->bind_prepare($companyName, $entity, $billing_id, $tid, '0', $primary_domain, 'Cloud Reseller', '0', '1');

if ($newCustStmt->execute()) {

    $companyIdStmt = $conn->prepare("Select id from customer where customer_name=?");
    $companyIdStmt->bind_prepare($companyName);
    $companyIdStmt->execute();

    if ($companyIdStmt->num_rows > 0) {

        $companyIdStmt->bind_result($company_id);

        $userNameStmt = $conn->prepare("Select username from user where username=?");
        $userNameStmt->bind_prepare($userName);
        $userNameStmt->execute();

        if ($userNameStmt->num_rows > 0) {
            echo "User already exists";
        } else {
            $newUserStmt = $conn->prepare("INSERT INTO user set username='$userName', customer_id='$company_id', commerce_id='$commerce_id', email='$email', role='10', tid='$tid'");
            $newUserStmt->bind_prepare($userName, $company_id, $commerce_id, $email, '10', $tid);

            if ($newUserStmt->execute()) {
                header("Location: ../portal/regSuccess.phtml");
            } else {
                echo "Error: " . $newUserStmt . "<br>" . $conn->error;
            }
        }
    } else {
        echo "Error: " . $newCustStmt . "<br>" . $conn->error;
    }
}
    