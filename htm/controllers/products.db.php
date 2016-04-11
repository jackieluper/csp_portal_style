<?php

session_start();
include 'config.php';
include '../classes/offers.class.php';

$index = 0;

$entity = $_SESSION['entity'];
//Set the id depending on entity type
if ($entity === 'Corporate') {
//SETS OFFER BASED ON OFFER ID
    $hotOffers = array('55', '11', '112');
} else if ($entity === 'Government') {
    $hotOffers = array('56', '12', '113');
}
//Setting offers for Corporate clients
$topOffers = new topOffers();
$offers = new offers();

for ($i = 0; $i < count($hotOffers); $i++) {
//Grabbing the product information to display in top offers
    $resultOffer1 = $conn->query("select offer.id, offer.display_name, erp_price from offer, offer_price where offer.id='$hotOffers[$i]' and offer_id='$hotOffers[$i]'");
    if ($resultOffer1->num_rows > 0) {
        while ($row = $resultOffer1->fetch_assoc()) {
            $name = $row['display_name'];
            $price = $row['erp_price'];
            $id = $row['id'];
        }
    }
    $topOffers->setOffer($index, $offer);
    $topOffers->setOfferDetails($index, $name, $price);
    $topOffers->setOfferId($index, $hotOffers[$i]);
    $resultImg = $conn->query("select img_tag, details from image where offer_name='$name'");
    if ($resultImg->num_rows > 0) {
        while ($row1 = $resultImg->fetch_assoc()) {
            $tag = $row1['img_tag'];
            $caption = $row1['details'];
            $topOffers->setOfferImg($index, $tag);
            $topOffers->setOfferCaption($index, $caption);
        }
    } else {
        $tag = "noImage.png";
        $topOffers->setOfferImg($index, $tag);
    }
    $index++;
}

$result1 = $conn->query("select offer.id, offer.display_name, offer.license_agreement_type, offer.purchase_unit, offer.sku, offer_price.erp_price from offer, offer_price where offer.id=offer_price.id and offer.license_agreement_type='$entity'");
$count = 0;
if ($result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        $name = $row['display_name'];
        $erp = $row['erp_price'];
        $purchase_unit = $row['purchase_unit'];
        $id = $row['id'];
        $offers->setOfferName($count, $name);
        $offers->setOfferPrice($count, $erp);
        $offers->setOfferUnit($count, $purchase_unit);
        $offers->setOfferId($count, $id);
        $resultImg = $conn->query("select img_tag, details from image where offer_name='$name'");
        if ($resultImg->num_rows > 0) {
            while ($row1 = $resultImg->fetch_assoc()) {
                $tag = $row1['img_tag'];
                $caption = $row1['details'];
                $offers->setOfferImg($count, $tag);
                $offers->setOfferCaption($count, $caption);
            }
        } else {
            $tag = "noImage.png";
            $offers->setOfferImg($count, $tag);
        }
        $count++;
    }
}
