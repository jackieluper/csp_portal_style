<?php

session_start();
require "../controllers/config.php";

$id = $_GET['id'];
$sqlOffer = "SELECT display_name, purchase_unit from offer where id='$id'";
$resOffer = $conn->query($sqlOffer);
if ($resOffer->num_rows > 0) {
    while ($row = $resOffer->fetch_assoc()) {
        $product_name = $row['display_name'];
        $purchase_unit = $row['purchase_unit'];
        $sqlPrice = "SELECT erp_price from offer_price where offer_id='$id' ";
        $resPrice = $conn->query($sqlPrice);
        if ($resPrice->num_rows > 0) {
            while ($row = $resPrice->fetch_assoc()) {
                $price = $row['erp_price'];
            }
        }
    }
}
$resultImg = $conn->query("select img_tag, details from image where offer_name='" . $product_name . "'");
if ($resultImg->num_rows > 0) {
    while ($row = $resultImg->fetch_assoc()) {
        $tag = $row['img_tag'];
        $details = $row['details'];
    }
} else {
    $tag = "noImage.png";
}