<!--
Author: Jason B. Smith
Date: 3/21/16
Managed Solution
-->
<?php
session_start();
require 'config.php';
include '../classes/invoice.class.php';
if (isset($_SESSION['invoiceId'])) {
    $invoiceId = $_SESSION['invoiceId'];
} else {
    $invoiceId = $_POST['invoiceId'];
}
$index = 0;

$invoiceReceipt = new invoiceReceipt();

$result = $conn->query("SELECT * FROM transactions where transaction_id='" . $invoiceId . "'");
while ($row = $result->fetch_assoc()) {
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
}

$invoiceReceipt->setInvoiceTotal($tranTotal);
$invoiceReceipt->setDiscountRate($discount);
$invoiceReceipt->setTotalSavings($totalSavings);

$getEmailStmt = "SELECT email from user where customer_id='$customer_id'";
$getEmailRes = $conn->query($getEmailStmt);
if ($getEmailRes->num_rows > 0) {
    while ($row = $getEmailRes->fetch_assoc()) {
        $email = $row['email'];
        echo $email;
    }
    $_SESSION['invoiceId'] = $tranId;
    $subject = "Invoice #$tranId";
    $message = "<div ><img class='invoiceLogo' src='../img/MS_Logo_orange_small.png' alt=' $companyName '></div>
                    <div style='font-size: 24px;'><strong>Order ID: '$invoiceId' </strong></div><br>";

    for ($i = 0; $i < count($invoiceReceipt->getSubscriptionId()); $i++) {
        $cost = number_format($invoiceReceipt->productCost[$i], 2);
        $qty = number_format($invoiceReceipt->productQty[$i], 0);
        $invoiceReceipt = $invoiceReceipt->itemNum[$i];
        $name = $invoiceReceipt->productName[$i];
        $subscriptionId = $invoiceReceipt->subscriptionId[$i];
        $message = $message + "$invoiceReceipt "
                . "--------------"
                . "Product Name: $name"
                . "Product ID: $subscriptionId"
                . "Subscription Length: 1 Month(s) "
                . "Product Cost: $ $cost "
                . "Product Quantity: $qty ";
    }
    $rate = number_format($invoiceReceipt->discountRate, 2);
    $savings = number_format($invoiceReceipt->totalSavings, 2);
    $total = number_format($invoiceReceipt->invoiceTotal, 2);
    $message = $message +
            "Discount Rate:  $rate % "
            . "Total Savings: $savings "
            . "Sale Total: $ $total ";

    $bcc = 'jsmith@managedsolution.com,jasonbsmith1568@yahoo.com';
    mail_utf8($email, $subject, $message, $bcc);
}
