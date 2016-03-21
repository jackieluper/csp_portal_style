<!--
Author: Jason B. Smith
Date: 3/21/16
Managed Solution
-->
<?php
session_start();
include '../classes/cart.class.php';
$index = 0;

$cart = new cart();

//Grabbing all the cart items to show on checkout page for the customer to make any last minute changes
$result = $conn->query("select items, item_name, msrp, qty from cart");
error_reporting(E_ALL ^ E_NOTICE);

while ($row = $result->fetch_assoc()) {
    $item = $row['items'];
    $name = $row['item_name'];
    $msrp = $row['msrp'];
    $qty = $row['qty'];
    $total1 += $row['msrp'] * $row['qty'];
    $cart->setItem($index, $item);
    $cart->setName($index, $name);
    $cart->setMsrp($index, $msrp);
    $cart->setQty($index, $qty);
    $index++;
}
//Calculate customer discount if any and display savings as well as new total
$sqlDiscount = "Select discount from customer where id='" . $_SESSION['custId'] . "'";
$resultDiscount = $conn->query($sqlDiscount);
if ($resultDiscount->num_rows > 0) {
    while ($row = $resultDiscount->fetch_assoc()) {
        $rate = $row['discount'];
        $discountDec = $rate / 100;
        $discountNum = $total1 * $discountDec;
        $total = $total1 - $discountNum;
    }
    $cart->setDiscount($discountNum);
    $cart->setDiscountRate($rate);
    $cart->setTotal($total);
}