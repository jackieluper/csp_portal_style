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
$subscription_id = $subscriptionList[$i]->getOfferId();
$subscription_name = $subscriptionList[$i]->getOfferName();

$sqlOfferId = "SELECT id from offer where sku='$subscription_id'";
$resOfferId = $conn->query($sqlOfferId);
if ($resOfferId->num_rows > 0) {
    while ($row = $resOfferId->fetch_assoc()) {
        $offerId = $row['id'];
        echo "offer id: " . $offerId . '<br>';
    }
} else {
    echo "Error: " . $sqlOfferId . "<br>" . $conn->error;
}

$sqlOfferData = "SELECT list_price, erp_price from offer_price where offer_id='$offerId'";
$resOfferData = $conn->query($sqlOfferData);
if ($resOfferData->num_rows > 0) {
    while ($row = $resOfferData->fetch_assoc()) {
        $list_price = $row['list_price'];
        $erp_price = $row['erp_price'];
        echo "list price: " . $list_price . '<br>';
        echo "erp price: " . $erp_price . '<br>';
    }
} else {
    echo "Error: " . $sqlOfferData . "<br>" . $conn->error;
}

$sqlProvision = "SELECT is_provised from customer where id='$customer_id'";
$resProvision = $conn->query($sqlProvision);
if ($resProvision->num_rows > 0) {
    while ($row = $resProvision->fetch_assoc()) {
        $provision = $row['is_provised'];
    }
    $sqlgetTranId = "SELECT transaction_id FROM transactions ORDER BY transaction_id DESC LIMIT 1";
    $resTranId = $conn->query($sqlgetTranId);
    if ($resTranId->num_rows > 0) {
        while ($row = $resTranId->fetch_assoc()) {
            $tranId = $row['transaction_id'];
            echo "transaction id: " . $tranId . '<br>';
        }
    } else {
        echo "Error: " . $sqlgetTranId . "<br>" . $conn->error;
    }
} else {
    echo "Error: " . $sqlProvision . "<br>" . $conn->error;
}
if ($provision == 1) {
    $subscriptionList[$i]->updateQuantity($qty);
    header("Location:../portal/manageSubscription.php");
} else {
    $sqlDeleteCart = "DELETE from cart where customer_id='$customer_id'";
    if ($conn->query($sqlDeleteCart) == True) {
        $sqlUpdateQty = "INSERT into cart (customer_id, items, item_name, our_cost, msrp, proposed_cost, qty, transaction_id)
               VALUES($customer_id, $subscription_id, $subscription_name, $list_price, $erp_price, $erp_price, $qty, $tranId)";
        if ($conn->query($sqlUpdateQty) == TRUE) {
            header("Location: ../portal/checkout.php");
        } else {
            echo "Error: " . $sqlUpdateQty . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sqlDeleteCart . "<br>" . $conn->error;
    }
}
?>