<?php
require 'config.php';

$qty = $_POST['qty'];
$i = $_POST['itemNum'];
$customer_id = $_SESSION['custId'];

$sqlCartCheck = "SELECT * from cart where customer_id='$customer_id'";
$resCartCheck = $conn->query($sqlCartCheck);
if($resCartCheck->num_rows > 0){
    $sqlDeleteCart = "DELETE from cart where customer_id='$customer_id'";
    if($conn->query($sqlAddCompany) == True){
        $sqlUpdateQty = "INSERT into cart set(customer_id, items, item_name, our_cost, msrp, proposed_cost, qty, transaction_id)"
                . "VALUES($customer_id,)"
    }
}


//$subscriptionList[$i]->updateQuantity($qty);
print '
<script> location.replace("../portal/manageSubscription.php"); </script>';