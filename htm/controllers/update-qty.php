<?php
session_start();
require 'config.php';
include "../portal/managedSubscription.php";

$qty = $_POST['qty'];
$i = $_POST['itemNum'];
$customer_id = $_SESSION['custId'];

$subscription = new Subscription($customerTenantId);
$subscriptionList = $subscription->getSubscriptionList();

/*
$sqlCartCheck = "SELECT * from cart where customer_id='$customer_id'";
$resCartCheck = $conn->query($sqlCartCheck);
if($resCartCheck->num_rows > 0){
    $sqlDeleteCart = "DELETE from cart where customer_id='$customer_id'";
    if($conn->query($sqlAddCompany) == True){
        $sqlUpdateQty = "INSERT into cart set(customer_id, items, item_name, our_cost, msrp, proposed_cost, qty, transaction_id)"
                . "VALUES($customer_id,)"
    }
}
*/
echo "test: " . $subscriptionList[$i]->getOfferName();
$subscriptionList[$i]->updateQuantity($qty);
header("Location:../portal/subscriptionInfo.php");
?>