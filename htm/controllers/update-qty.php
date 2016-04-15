<?php

session_start();
require 'config.php';
require '../controllers/email.php';
include '../controllers/displayInvoice.db.php';
require "../api/client/_init.php";

$invoiceId = $_SESSION['invoiceId'];
$qty = $_POST['qty'];
$i = $_POST['itemNum'];
$_SESSION['itemNum'] = $i;
$_SESSION['qty'] = $qty;
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
        $erp_price = number_format($row['erp_price'], 2);
        echo "list price: " . $list_price . '<br>';
        echo "erp price: " . $erp_price . '<br>';
    }
} else {
    echo "Error: " . $sqlOfferData . "<br>" . $conn->error;
}

$sqlProvision = "SELECT is_provised, discount from customer where id='$customer_id'";
$resProvision = $conn->query($sqlProvision);
if ($resProvision->num_rows > 0) {
    while ($row = $resProvision->fetch_assoc()) {
        $provision = $row['is_provised'];
        $discount = number_format($row['discount'], 2);
    }
    $sqlgetTranId = "SELECT transaction_id FROM transactions ORDER BY transaction_id DESC LIMIT 1";
    $resTranId = $conn->query($sqlgetTranId);
    if ($resTranId->num_rows > 0) {
        while ($row = $resTranId->fetch_assoc()) {
            $tranId = $row['transaction_id'] + 2;
            echo "transaction id: " . $tranId . '<br>';
        }
    } else {
        echo "Error: " . $sqlgetTranId . "<br>" . $conn->error;
    }
} else {
    echo "Error: " . $sqlProvision . "<br>" . $conn->error;
}
if ($provision == 1) {
    $updateQty = intval($qty - $subscriptionList[$i]->getQuantity());
    $total = number_format($updateQty * $erp_price, 2);
    $totalSavings = number_format($total * $discount, 2);
    $subscriptionList[$i]->updateQuantity($qty);

    $sqlInvoice = "INSERT INTO transactions(customer_id, item_num, sku, product_name, subscription_length, product_cost, qty, discount_rate, total_savings, total, transaction_id)
            VALUES('$customer_id', '1', '$subscription_id', '$subscription_name', '1 month(s)', '$erp_price', '$updateQty', '$discount', '$totalSavings', '$total', $tranId)";
    echo $customer_id;
    if ($conn->query($sqlInvoice) == TRUE) {
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
                $message = $message + "$invoiceReceipt->itemNum[$i] "
                        . "--------------"
                        . "Product Name: $invoiceReceipt->productName[$i]"
                        . "Product ID: $invoiceReceipt->subscriptionId[$i]"
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
            header('Location: ../portal/displayInvoice.php');
        }
    } else {
        echo "Error: " . $sqlInvoice . "<br>" . $conn->error;
    }
} else {
    $sqlDeleteCart = "DELETE from cart where customer_id='$customer_id'";
    if ($conn->query($sqlDeleteCart) == True) {
        $updateQty = $qty - $subscriptionList[$i]->getQuantity();
        if ($updateQty <= 0) {
            $subscriptionList[$i]->updateQuantity($qty);
            header("Location: ../portal/subscriptionInfo.php");
        } else {
            $sqlUpdateQty = "INSERT into cart (customer_id, items, item_name, our_cost, msrp, proposed_cost, qty, transaction_id, updat_qty)
               VALUES('$customer_id', '$subscription_id', '$subscription_name', '$list_price', '$erp_price', '$erp_price', '$updateQty', '$tranId', '1')";
            if ($conn->query($sqlUpdateQty) == TRUE) {
                header("Location: ../portal/checkout.php");
            } else {
                echo "Error: " . $sqlUpdateQty . "<br>" . $conn->error;
            }
        }
    } else {
        echo "Error: " . $sqlDeleteCart . "<br>" . $conn->error;
    }
}