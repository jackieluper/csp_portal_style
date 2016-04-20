<?php
include 'config.php';
include '../classes/offers.class.php';

$index = 0;
$entity = $_SESSION['entity'];
$offers = new offers();

try {
    $getOfferDetails = "SELECT top_offer, offer.id, offer.display_name, offer.license_agreement_type, offer.purchase_unit, offer.sku, offer_price.erp_price FROM offer, offer_price WHERE offer.id=offer_id AND offer.license_agreement_type='$entity'";
    $offerDetailsRes = $conn->query($getOfferDetails);
    $index = 0;
    if ($offerDetailsRes->num_rows > 0) {
        while ($row = $offerDetailsRes->fetch_assoc()) {
            $name = $row['display_name'];
            $erp = $row['erp_price'];
            $purchase_unit = $row['purchase_unit'];
            $id = $row['id'];
            $topOffer = $row['top_offer'];
            $offers->setOfferName($index, $name);
            $offers->setOfferPrice($index, $erp);
            $offers->setOfferUnit($index, $purchase_unit);
            $offers->setOfferId($index, $id);
            $offers->setTopOffer($index, $topOffer);

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