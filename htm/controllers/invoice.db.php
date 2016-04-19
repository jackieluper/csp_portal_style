<!--
Author: Jason B. Smith
Date: 3/21/16
Managed Solution
-->
<?php
session_start();
include 'config.php';
require "../api/client/_init.php";
include '../classes/invoice.class.php';

$invoice = new invoice();
$index = 0;

$getCustTran = "SELECT total, transaction_id FROM transactions where customer_ids='" . $_SESSION['custId'] . "' GROUP BY transaction_id ORDER BY transaction_id";
$custTransRes = $conn->query($getCustTran);
while ($row = $custTransRes->fetch_assoc()) {
    $tranTotal = $row['total'];
    $tranId = $row['transaction_id'];
    $invoice->setInvoiceTotal($index, $tranTotal);
    $invoice->setInvoiceTranId($index, $tranId);
    $index++;
}

