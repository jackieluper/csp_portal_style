<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
session_start();
require("config.php");
require "../api/client/_init.php";

$found = false;
$customer_id = $_SESSION['custId'];
$customerTenantId = $_SESSION['tid'];
$subscription = new Subscription($customerTenantId);
$subscriptionList = $subscription->getSubscriptionList();


//getting the offer id which is the id of the item selected
$offerID = $_POST['id'];
$qty = $_POST['qty'];
//getting last transaction id
$sqlGetTran = "SELECT transaction_id FROM transactions ORDER BY transaction_id DESC LIMIT 1";
$tranResult = $conn->query($sqlGetTran);
if ($tranResult->num_rows > 0) {
    while ($row = $tranResult->fetch_assoc()) {
        $transactionId = $row['transaction_id'] + 2;
    }
} else {
    $transactionId = 1;
}
//setting query to get customer id for the user that has logged on
$sql = "SELECT customer_id from user WHERE username='" . $_SESSION['user'] . "'";
$result = $conn->query($sql);

//grabbing the customer id if exists and storing it to php variable
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $custID = $row['customer_id'];
    }
}
//Grabbing the sku for the product selected
$sqlId = "SELECT sku, offer_uri from offer WHERE id='" . $offerID . "'";
$resultId = $conn->query($sqlId);
if ($resultId->num_rows > 0) {
    while ($row = $resultId->fetch_assoc()) {
        $offerSku = $row['sku'];
        $offerUri = $row['offer_uri'];
        echo 'test2';
    }
}

//setting query to get our price, and resale price for the offer selected
$sql1 = "SELECT list_price, erp_price from offer_price WHERE offer_id='" . $offerID . "'";
$result1 = $conn->query($sql1);
//grabbing our price and resale price(erp)
if ($result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        $erpPrice = $row['erp_price'];
        $listPrice = $row['list_price'];
        echo 'test3';
    }
}
//setting query to get item already in cart and increment
$sql3 = "SELECT qty from cart where items='" . $offerID . "'";
$result3 = $conn->query($sql3);

//setting query to get the display name from offers
$sql5 = "SELECT display_name from offer where id='" . $offerID . "'";
$result5 = $conn->query($sql5);
//grabbing the display name from offers
if ($result5->num_rows > 0) {
    while ($row = $result5->fetch_assoc()) {
        $offerName = $row['display_name'];
        echo 'test4';
    }
}
for ($i = 0; $i < count($subscriptionList); $i++) {
    $subscription_id = $subscriptionList[$i]->getOfferId();
    $subscription_name = $subscriptionList[$i]->getOfferName();
    echo $subscription_name . '<br>';
    if ($subscription_name == "$offerName") {
        $found = true;
        $_SESSION['itemNum'] = $i;
        header("Location: ../portal/subscriptionInfo.php");
        break;
    }
}

if ($found = false) {
//query to add the selected item to the cart with corresponding customer info
    $sql2 = "INSERT INTO cart (customer_id, items, item_name, our_cost, msrp, proposed_cost, qty, transaction_id, updat_qty, sku, offer_uri) 
VALUES ('$custID', '$offerID', '$offerName', '$listPrice', '$erpPrice', '$erpPrice', '$qty', '$transactionId', '0', '$offerSku', '$offerUri')" or die(mysql_error());
//query to add the selected item to the cart with corresponding customer info
    $sql2 = "INSERT INTO cart (customer_id, items, item_name, our_cost, msrp, proposed_cost, qty, transaction_id, updat_qty, sku, offer_uri) 
VALUES ('$custID', '$offerID', '$offerName', '$listPrice', '$erpPrice', '$erpPrice', '$qty', '$transactionId', '0', '$offerSku', '$offerUri')" or die(mysql_error());
//if they already have in cart increment qty 
    if ($result3->num_rows > 0) {
        while ($row = $result3->fetch_assoc()) {
            $qty = $row['qty'] + $qty;
            $sql4 = "UPDATE cart SET qty='" . $qty . "' where items='" . $offerID . "'";
            if ($conn->query($sql4) === TRUE) {
                //header('Location: ../portal/products.php');
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    }
//else just add to the cart and redirect back to product page
    else if ($conn->query($sql2) === TRUE) {
        //header('Location: ../portal/products.php');
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
//close DB connection
    $conn->close();
    ?>