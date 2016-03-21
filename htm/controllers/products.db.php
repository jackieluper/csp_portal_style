<!--
Author: Jason B. Smith
Date: 3/21/16
Managed Solution
-->
<?php
session_start();
include 'config.php';
include '../classes/offers.class.php';

$index = 0;

//Setting offers for Corporate clients
$topOffers = new topOffers();
$offers = new offers();

for ($i = 0; $i < count($hotOffers); $i++) {
//Grabbing the product information to display in top offers
    $resultOffer1 = $conn->query("select offer.display_name, erp_price from offer, offer_price where offer.id='$hotOffers[$i]' and offer_id='$hotOffers[$i]'");
    while ($row = $resultOffer1->fetch_assoc()) {
        $name = $row['display_name'];
        $price = $row['erp_price'];
        $id = $row['id'];
    }
    $topOffers->setOffer($index, $offer);
    $topOffers->setOfferDetails($index, $name, $price);
    $topOffers->setOfferId($index, $hotOffers[$i]);
    $index++;
}

$result1 = $conn->query("select offer.id, offer.display_name, offer.license_agreement_type, offer.purchase_unit, offer.sku, offer_price.erp_price from offer, offer_price where offer.id=offer_price.id and offer.license_agreement_type='$entity'");
$index = 0;
while ($row = $result1->fetch_assoc()) {
    $name = $row['display_name'];
    $erp = $row['erp_price'];
    $purchase_unit = $row['purchase_unit'];
    $id = $row['id'];
    $offers->setOfferName($index, $name);
    $offers->setOfferPrice($index, $erp);
    $offers->setOfferUnit($index, $purchase_unit);
    $offers->setOfferId($index, $id);
    $index++;
}
