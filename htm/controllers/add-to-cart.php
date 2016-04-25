<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require("config.php");
require "../api/client/_init.php";

$found = false;
$customer_id = $_SESSION['custId'];
$customerTenantId = $_SESSION['tid'];
$subscription = new Subscription($customerTenantId);
$subscriptionList = $subscription->getSubscriptionList();


//getting the offer id which is the id of the item selected
$sf_offer_id = $conn->real_escape_string($_POST['id']);
$sf_user_name = $conn->real_escape_string($_SESSION['user']);
$qty = intval($_POST['qty']);

//getting last transaction id
$sqlGetTran = "SELECT transaction_id FROM transactions ORDER BY transaction_id DESC LIMIT 1";
$tranResult = $conn->query($sqlGetTran);
if ($tranResult->num_rows > 0) {
    while ($row = $tranResult->fetch_assoc()) {
        $transactionId = $row['transaction_id'] + 1;
    }
} else {
    $transactionId = 1;
}

//setting query to get customer id for the user that has logged on
$getCustId = "SELECT customer_id from user WHERE username='$sf_user_name'";
$custIdRes = $conn->query($getCustId);
//grabbing the customer id if exists and storing it to php variable
if ($custIdRes->num_rows > 0) {
    while ($row = $custIdRes->fetch_assoc()) {
        $custID = $row['customer_id'];
    }
}

//Grabbing the sku for the product selected
$getProdSku = "SELECT sku, offer_uri from offer WHERE id='$sf_offer_id'";
$prodSkuRes = $conn->query($getProdSku);
if ($prodSkuRes->num_rows > 0) {
    while ($row = $prodSkuRes->fetch_assoc()) {
        $offerSku = $row['sku'];
        $offerUri = $row['offer_uri'];
    }
}

//setting query to get our price, and resale price for the offer selected
$getProdPrice = "SELECT list_price, erp_price from offer_price WHERE offer_id='$sf_offer_id'";
$prodPriceRes = $conn->query($getProdPrice);
if ($prodPriceRes->num_rows > 0) {
    while ($row = $prodPriceRes->fetch_assoc()) {
        $erpPrice = $row['erp_price'];
        $listPrice = $row['list_price'];
    }
}

//setting query to get the display name from offers
$getProdName = "SELECT display_name from offer where id='$sf_offer_id'";
$prodNameRes = $conn->query($getProdName);
//grabbing the display name from offers
if ($prodNameRes->num_rows > 0) {
    while ($row = $prodNameRes->fetch_assoc()) {
        $offerName = $row['display_name'];
    }
}

for ($i = 0; $i < count($subscriptionList); $i++) {
    $subscription_id = $subscriptionList[$i]->getOfferId();
    $subscriptionList[$i]->getOfferName();
    echo $subscription_name . '<br>';
    if ($subscription_name == $offerName) {
        $found = true;
        $_SESSION['updateQty'] = $qty;
        $_SESSION['itemNum'] = $i;
        header("Location: ../portal/subscriptionInfo.php");
        break;
    }
}

if ($found == false) {
    //query to add the selected item to the cart with corresponding customer info
    $insCart = "INSERT INTO cart (customer_id, items, item_name, our_cost, msrp, proposed_cost, qty, transaction_id, updat_qty, sku, offer_uri) 
             VALUES ('$custID', '$sf_offer_id', '$offerName', '$listPrice', '$erpPrice', '$erpPrice', '$qty', '$transactionId', '0', '$offerSku', '$offerUri')" or die(mysql_error());

    //setting query to get item already in cart and increment
    $getQtyCart = "SELECT qty from cart where items='$sf_offer_id'";
    $qtyCartRes = $conn->query($getQtyCart);
    //if they already have in cart increment qty 
    if ($qtyCartRes->num_rows > 0) {
        while ($row = $qtyCartRes->fetch_assoc()) {
            $qty = $row['qty'] + $qty;
            $updQtyCart = "UPDATE cart SET qty='" . $qty . "' where items='" . $sf_offer_id . "'";
            if ($conn->query($updQtyCart) === TRUE) {
                //header('Location: ../portal/products.php');
                echo "Micro: $subscription_name <br>";
                echo "Ours : $offerName";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    }
    //else just add to the cart and redirect back to product page
    else if ($conn->query($insCart) === TRUE) {
        header('Location: ../portal/products.php');
    } else {
        echo "Error: " . $insCart . "<br>" . $conn->error;
    }
}
?>