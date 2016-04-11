<?php
session_start();
require "../controllers/config.php";
require "../api/client/_init.php";

$i = $_SESSION['itemNum'];
$customerTenantId = $_SESSION['tid'];
$qty = $_SESSION['qty'];
$customer_id = $_SESSION['custId'];

$subscription = new Subscription($customerTenantId);
$subscriptionList = $subscription->getSubscriptionList();
$subscription_id = $subscriptionList[$i]->getOfferId();
$subscription_name = $subscriptionList[$i]->getOfferName();

echo $subscriptionList[$i]->getQuantity();
$subscriptionList[$i]->updateQuantity($qty); 

$sqlInvoice = "INSERT INTO transactions(customer_id, item_num, sku, product_name, subscription_length, product_cost, qty, discount_rate, total_savings, total, transaction_id)
            VALUES('$customer_id', '1', '$subscription_id', '$subscription_name', '1 month(s)', '$erp_price', '$updateQty', '$discount', '$totalSavings', '$total', $tranId)";

if ($conn->query($sqlInvoice) == TRUE) {
    $_SESSION['invoiceId'] = $tranId;
    header('Location: ../portal/displayInvoice.php');
} else {
    echo "Error: " . $sqlInvoice . "<br>" . $conn->error;
}