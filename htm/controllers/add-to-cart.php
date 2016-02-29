<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->

//TODO: FINALIZE ADJUSTMENT TO CART QTY UPDATES TOTAL
<?php
require("config.php");
session_start();

//getting the offer id which is the id of the item selected
$offerID = $_GET['id'];
echo 'offer id is: ' . $offerID . '<br>';

//setting query to get customer id for the user that has logged on
$sql = "SELECT customer_id from user WHERE username='" . $_SESSION['username'] . "'";
$result = $conn->query($sql);

//grabbing the customer id if exists and storing it to php variable
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $custID = $row['customer_id'];
    }
}
//setting query to get our price, and resale price for the offer selected
$sql1 = "SELECT list_price, erp_price from offer_price WHERE id='" . $offerID . "'";
$result1 = $conn->query($sql1);
//grabbing our price and resale price(erp)
if ($result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        $erpPrice = $row['erp_price'];
        $listPrice = $row['list_price'];
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
        echo 'Offer Name: ' . $offerName = $row['display_name'] . '<br>';
    }
}
//query to add the selected item to the cart with corresponding customer info
$sql2 = "INSERT INTO cart (customer_id, items, item_name, our_cost, msrp, proposed_cost, qty) 
VALUES ('$custID', '$offerID', '$offerName', '$listPrice', '$erpPrice', '$erpPrice', '1')" or die(mysql_error());
//if they already have in cart increment qty 
if ($result3->num_rows > 0) {
    while ($row = $result3->fetch_assoc()) {
        $qty = $row['qty'] + 1;
        $sql4 = "UPDATE cart SET qty='" . $qty . "' where items='" . $offerID . "'";
        if ($conn->query($sql4) === TRUE) {
            header('Location: ../portal/products.phtml');
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}
//else if just add to the cart
else if ($conn->query($sql2) === TRUE) {
    header('Location: ../portal/products.phtml');
} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
}

$conn->close();
?>