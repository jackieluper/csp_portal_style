<!--
Author: Jason B. Smith
Date: 3/21/16
Managed Solution
-->
<?php

session_start();
include 'config.php';
include '../classes/admin.class.php';

$index = 0;
$admin = new admin();

//Grabs all company information for admin to adjust provisioning and discounts
//Provisioning means a customer that does not have to input Credit Card Information  
$result = $conn->query("select id, customer_name, primary_domain, relationship, is_provised, discount, active from customer");

while ($row = $result->fetch_assoc()) {
    $custId = $row['id'];
    $discount = $row['discount'];
    $custName = $row['customer_name'];
    $primDomain = $row['primary_domain'];
    $custRelationship = $row['relationship'];
    $active = $row['active'];
    //Setting provisions to visual cue to the administrator
    if ($active == 1) {
        if ($row['is_provised'] == 1) {
            $provision = "Y";
        } else {
            $provision = "N";
        }
        $admin->setCustId($index, $custId);
        $admin->setDiscount($index, $discount);
        $admin->setCustName($index, $custName);
        $admin->setPrimDomain($index, $primDomain);
        $admin->setCustRelationship($index, $custRelationship);
        $admin->setProvision($index, $provision);
        $index++;
    }
}
?>