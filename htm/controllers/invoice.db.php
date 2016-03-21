<!--
Author: Jason B. Smith
Date: 3/21/16
Managed Solution
-->
<?php

session_start();
include 'config.php';
include '../classes/invoice.class.php';

$invoice = new invoice();
$index = 0;
$result = $conn->query("SELECT total, transaction_id FROM transactions where customer_id='" . $_SESSION['custId'] . "' GROUP BY transaction_id");
error_reporting(E_ALL ^ E_NOTICE);
while ($row = $result->fetch_assoc()) {
    $tranTotal = $row['total'];
    $tranId = $row['transaction_id'];
    $invoice->setInvoiceTotal($index, $tranTotal);
    $invoice->setInvoiceTranId($index, $tranId);
    $index++;
}

