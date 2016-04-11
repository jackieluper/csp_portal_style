<?php

session_start();
require "../controllers/config.php";
require "../api/client/_init.php";

$updateQty = intval($qty - $subscriptionList[$i]->getQuantity());
$total = number_format($updateQty * $erp_price, 2);
$totalSavings = number_format($total * $discount, 2);
$subscriptionList[$i]->updateQuantity($qty);

$sqlInvoice = "INSERT INTO transactions(customer_id, item_num, sku, product_name, subscription_length, product_cost, qty, discount_rate, total_savings, total, transaction_id)
            VALUES('$customer_id', '1', '$subscription_id', '$subscription_name', '1 month(s)', '$erp_price', '$updateQty', '$discount', '$totalSavings', '$total', $tranId)";

if ($conn->query($sqlInvoice) == TRUE) {
    $_SESSION['invoiceId'] = $tranId;
    header('Location: ../portal/displayInvoice.php');
} else {
    echo "Error: " . $sqlInvoice . "<br>" . $conn->error;
}