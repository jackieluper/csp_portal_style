<!--
Author: Jason B. Smith
Date: 3/21/16
Managed Solution
-->
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'config.php';
require '../classes/invoice.class.php';

if(isset($_POST['invoiceId'])){
$invoiceId = $_POST['invoiceId'];
}
else{
    $invoiceId = $_SESSION['invoiceId'];
}

$index = 0;
$invoiceReceipt = new invoiceReceipt();
$invoice = new invoice();


try {
    $getTranDetails = "SELECT * FROM transactions WHERE transaction_id='$invoiceId'";
    $tranDetailRes = $conn->query($getTranDetails);
    if ($tranDetailRes->num_rows > 0) {
        while ($row = $tranDetailRes->fetch_assoc()) {
            $subscriptionId = $row['sku'];
            $itemNum = $row['item_num'];
            $productName = $row['product_name'];
            $subscriptionLength = $row['subscription_length'];
            $productCost = $row['product_cost'];
            $qty = $row['qty'];
            $tranTotal = $row['total'];
            $discount = $row['discount_rate'];
            $totalSavings = $row['total_savings'];

            $invoiceReceipt->setSubscriptionId($index, $subscriptionId);
            $invoiceReceipt->setItemNum($index, $itemNum);
            $invoiceReceipt->setProductName($index, $productName);
            $invoiceReceipt->setSubscriptionLength($index, $subscriptionLength);
            $invoiceReceipt->setProductCost($index, $productCost);
            $invoiceReceipt->setProductQty($index, $qty);
            $index++;

            $invoiceReceipt->setInvoiceTotal($tranTotal);
            $invoiceReceipt->setDiscountRate($discount);
            $invoiceReceipt->setTotalSavings($totalSavings);
        }
        $invoice->setInvoiceTranId($index, $invoiceId);
    }
    else{
        throw new Exception("MySql Error: " . $getTranDetails . "<br>" . $conn->error);
    }
} catch (Exception $e) {
    echo $e->getMessage();
} 


