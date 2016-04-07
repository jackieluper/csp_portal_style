<?php
session_start();
require 'config.php';
require "../api/client/_init.php";

$qty = $_POST['qty'];
$i = $_POST['itemNum'];
$customer_id = $_SESSION['custId'];
$customerTenantId = $_SESSION['tid'];
$subscription = new Subscription($customerTenantId);
$subscriptionList = $subscription->getSubscriptionList();

$sqlProvision = "SELECT is_provised from customer where id='$customer_id'";
$resProvision = $conn->query($sqlProvision);
if($resProvision->num_rows > 0){
    while ($row = $resProvision->fetch_assoc()) {
        $provision = $row['is_provised'];
    }
}
else{
    echo "Error: " . $sqlProvision . "<br>" . $conn->error;
}
echo "provision: " . $provision;
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

//$subscriptionList[$i]->updateQuantity($qty);
//header("Location:../portal/manageSubscription.php");
?>