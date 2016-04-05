<!--
Author: Jason B. Smith
Date: 3/21/16
Managed Solution
-->
<?php
sess_start();
include '../classes/cart.class.php';
$index = 0;
$cart = new cart();

//Grabbing all the cart items to show on checkout page for the customer to make any last minute changes
$result = $conn->query("select items, item_name, msrp, qty from cart");

$total = 0;
while ($row = $result->fetch_assoc()) {
    $item = $row['items'];
    $name = $row['item_name'];
    $msrp = $row['msrp'];
    $qty = $row['qty'];
    $total1 = $msrp * $qty;
    $total1 += $total + $total1;
    $cart->setItem($index, $item);
    $cart->setName($index, $name);
    $cart->setMsrp($index, $msrp);
    $cart->setQty($index, $qty);
    $index++;
}
$cart->setTotal($total1);
//Calculate customer discount if any and display savings as well as new total
$sqlDiscount = "Select discount from customer where customer_name='" . $_SESSION['company_name'] . "'";
$resultDiscount = $conn->query($sqlDiscount);
while ($row = $resultDiscount->fetch_assoc()) {
    $rate = $row['discount'];
    $discountDec = $rate / 100;
    $discountNum = $total1 * $discountDec;
    $total = $total1 - $discountNum;
    $cart->setDiscount($discountNum);
    $cart->setDiscountRate($rate);
}
$cart->setTotal($total);

