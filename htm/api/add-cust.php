<!--
Author: Jason B. Smith
Date: 2/29/16
Managed Solution
-->
<?php
session_start();
require '../controllers/config.php';
require_once '../api/client/_init.php';
require '../controllers/email.php';

echo 'test';
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
        setBillingAddressPhoneNumber($_POST['phoneNum']);
$customer->createCustomer();
$sf_user_name = 'admin@' . $customer->getCompanyDomain();
$commerce_id = $customer->getCommerceId();
$email = $customer->getBillingEmail();
$tid = $customer->getCompanyTenantId();
$companyName = $customer->getCompanyName();
$entity = $_POST['businessType'];
$billing_id = $customer->getBillingId();
$primary_domain = $customer->getCompanyDomain();
$sf_pass = $customer->getPassword();
$_SESSION['username'] = $sf_user_name;
$_SESSION['pwd'] = $sf_pass;

//sanitizing input data from user
$sf_company_name = $conn->real_escape_string($companyName);
$sf_entity = $conn->real_escape_string($entity);
$sf_billing_id = $conn->real_escape_string($billing_id);
$sf_tid = $conn->real_escape_string($tid);
$sf_primary_domain = $conn->real_escape_string($primary_domain);
$sf_commerce_id = $conn->real_escape_string($commerce_id);
$sf_email = $conn->real_escape_string($email);


$newCustomerStmt = "INSERT INTO customer (customer_name, entity_type, billing_id, company_tid, is_provised, primary_domain, relationship, discount, active) 
        VALUES ( '$sf_company_name', '$sf_entity', '$sf_billing_id', '$sf_tid', '0', '$sf_primary_domain', 'Cloud Reseller', '0', '1')";
$newCustRes = $conn->query($newCustomerStmt);

if ($newCustRes) {
        
    $compIdStmt = "Select id from customer where customer_name='$sf_company_name'";
    $compIdRes = $conn->query($compIdStmt);
    
    while ($row = $compIdRes->fetch_assoc()) {
        
        $sf_company_id = $row['id'];
        
    }
    
    $checkUserStmt = "Select username from user where username='$sf_user_name'";
    $checkUserRes = $conn->query($checkUserStmt);
    
    if ($checkUserRes->num_rows > 0) {
        
        echo "User already exists";
        
    } else {
        
        $newUserStmt = "INSERT INTO user (username, customer_id, commerce_id, email, role, tid) VALUES ('$sf_user_name', '$sf_company_id', '$sf_commerce_id', '$sf_email', '10', '$sf_tid')";
        $newUserRes = $conn->query($newUserStmt);
        
        if ($newCustRes) {
            
            $subject = "Registration Information";
            $message = "Please save your username: $sf_user_name "
                    . "and your Password: $sf_pass";
            mail_utf8($email, $subject, $message);
            header("Location: ../portal/regSuccess.phtml");
            
        } else {
            
            echo "Error: " . $newUserStmt . "<br>" . $conn->error;
            
        }
    }
} else {
    
    echo "Error: " . $newCustomerStmt . "<br>" . $conn->error;
    
}
  