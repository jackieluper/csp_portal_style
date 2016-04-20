<?php

include 'config.php';
include '../classes/offers.class.php';

$index = 0;
$entity = $_SESSION['entity'];
$topOffers = new topOffers();
$offers = new offers();

try {
//Set the id depending on entity type
    if ($entity === 'Corporate') {
//SETS OFFER BASED ON OFFER ID
        $hotOffers = array('55', '11', '112');
    } else if ($entity === 'Government') {
        $hotOffers = array('56', '12', '113');
    }

    for ($i = 0; $i < count($hotOffers); $i++) {
        //Grabbing the product information to display in top offers
        $getTopOfferDetails = "SELECT offer.id, offer.display_name, erp_price FROM offer, offer_price WHERE offer.id='$hotOffers[$i]' AND offer_id='$hotOffers[$i]'";
        $topOfferDetailRes = $conn->query($getTopOfferDetails);
        if ($topOfferDetailRes->num_rows > 0) {
            while ($row = $topOfferDetailRes->fetch_assoc()) {
                $name = $row['display_name'];
                $price = $row['erp_price'];
                $id = $row['id'];
            }
        } else {
            throw new Exception("MySql Error: " . $getTopOfferDetails . "<br>" . $conn->error);
        }
        //creating topOffers->object TODO: MAKE JUST OFFER OBJECT AND REFERENCE TOPOFFERS IN DB
        $topOffers->setOffer($index, $offer);
        $topOffers->setOfferDetails($index, $name, $price);
        $topOffers->setOfferId($index, $hotOffers[$i]);
        $getImgSet = "SELECT img_tag, details FROM image WHERE offer_name='$name'";
        $imgSetRes = $conn->query($getImgSet);
        if ($imgSetRes->num_rows > 0) {
            while ($row1 = $imgSetRes->fetch_assoc()) {
                $tag = $row1['img_tag'];
                $caption = $row1['details'];
                $topOffers->setOfferImg($index, $tag);
                $topOffers->setOfferCaption($index, $caption);
            }
        } else {
            $tag = "noImage.png";
            $topOffers->setOfferImg($index, $tag);
            throw new Exception("MySql Error: " . $imgSetRes . "<br>" . $conn->error);
        }
        $index++;
    }
    $getOfferDetails = "SELECT offer.id, offer.display_name, offer.license_agreement_type, offer.purchase_unit, offer.sku, offer_price.erp_price FROM offer, offer_price WHERE offer.id=offer_id AND offer.license_agreement_type='$entity'";
    $offerDetailsRes = $conn->query($getOfferDetails);
    $index = 0;
    if ($offerDetailsRes->num_rows > 0) {
        while ($row = $offerDetailsRes->fetch_assoc()) {
            $name = $row['display_name'];
            $erp = $row['erp_price'];
            $purchase_unit = $row['purchase_unit'];
            $id = $row['id'];
            $offers->setOfferName($index, $name);
            $offers->setOfferPrice($index, $erp);
            $offers->setOfferUnit($index, $purchase_unit);
            $offers->setOfferId($index, $id);
            
            $getImgSet = "SELECT img_tag, details FROM image WHERE offer_name='$name'";
            $imgSetRes = $conn->query($getImgSet);
            if ($imgSetRes->num_rows > 0) {
                while ($row1 = $imgSetRes->fetch_assoc()) {
                    $tag = $row1['img_tag'];
                    $caption = $row1['details'];
                    $offers->setOfferImg($index, $tag);
                    $offers->setOfferCaption($index, $caption);
                }
            } else {
                $tag = "noImage.png";
                $offers->setOfferImg($index, $tag);
                throw new Exception("MySql Error: " . $imgSetRes . "<br>" . $conn->error);
            }
            $index++;
        }
    } else {
        throw new Exception("MySql Error: " . $getOfferDetails . "<br>" . $conn->error);
    }
} catch (Exception $e) {
    echo $e->getMessage();
} 