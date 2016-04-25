<!--
Author: Jason B. Smith
Date: 3/21/16
Managed Solution
-->
<?php
require '../classes/cart.class.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['company_name'])){
    $companyName = $_SESSION['company_name'];
    $custId = $_SESSION['custId'];
}
else{
    $companyName = null;
    $custId = null;
}
$index = 0;
$cart = new cart();

//Grabbing all the cart items to show on checkout page for the customer to make any last minute changes
$result = $conn->query("select items, item_name, msrp, qty from cart where customer_id =$custId");

$total = 0;
while ($row = $result->fetch_assoc()) {
    $item = $row['items'];
    $name = $row['item_name'];
    $msrp = $row['msrp'];
    $qty = $row['qty'];
    $total += $msrp * $qty;
    $cart->setItem($index, $item);
    $cart->setName($index, $name);
    $cart->setMsrp($index, $msrp);
    $cart->setQty($index, $qty);
    $index++;
}
$cart->setTotal($total);
//Calculate customer discount if any and display savings as well as new total
$sqlDiscount = "Select discount from customer where customer_name='$companyName'";
$resultDiscount = $conn->query($sqlDiscount);
while ($row = $resultDiscount->fetch_assoc()) {
    $rate = $row['discount'];
    $discountDec = $rate / 100;
    $discountNum = $total * $discountDec;
    $total = $total - $discountNum;
    $cart->setDiscount($discountNum);
    $cart->setDiscountRate($rate);
}
$cart->setTotal($total);

