<?php
require 'config.php';
require '../classes/offers.class.php';
//Checking if session is still active
if (session_status() == PHP_SESSION_NONE) {
    header("Location: logout.php");
}
//setting initial variables/objects
$entity = $_SESSION['entity'];
$offers = new offers();

try {
    //query to get offer details and to determine if it is a top offer or not
    $getOfferDetails = "SELECT top_offer, offer.id, offer.display_name, offer.license_agreement_type, offer.purchase_unit, offer.secondary_license_type, offer.sku, offer_price.erp_price FROM offer, offer_price WHERE offer.id=offer_id AND offer.license_agreement_type='$entity'";
    $offerDetailsRes = $conn->query($getOfferDetails);
    $index = 0;
    if ($offerDetailsRes->num_rows > 0) {
        while ($row = $offerDetailsRes->fetch_assoc()) {
            $addon = $row['secondary_license_type'];
            if ($addon != 'ADDON') {
                $name = $row['display_name'];
                $erp = $row['erp_price'];
                $purchase_unit = $row['purchase_unit'];
                $id = $row['id'];
                $topOffer = $row['top_offer'];
                //setting DB data to offers object
                $offers->setOfferName($index, $name);
                $offers->setOfferPrice($index, $erp);
                $offers->setOfferUnit($index, $purchase_unit);
                $offers->setOfferId($index, $id);
                $offers->setTopOffer($index, $topOffer);
                //setting the img to the name of the corresponding offer
                $getImgSet = "SELECT img_tag, details FROM image WHERE offer_name='$name'";
                $imgSetRes = $conn->query($getImgSet);
                if ($imgSetRes->num_rows > 0) {
                    while ($row1 = $imgSetRes->fetch_assoc()) {
                        $tag = $row1['img_tag'];
                        $caption = $row1['details'];

                        $offers->setOfferImg($index, $tag);
                        $offers->setOfferCaption($index, $caption);
                    }
                    //if not
                } else {
                    $tag = "noImage.png";
                    $offers->setOfferImg($index, $tag);
                    $message = "No Image Exception: $getImgSet \n" ;
                            " Product Name: $name";
                    $email = 'jsmith@managedsolution.com';
                    $bcc = "csperrors@managedsolution.com";
                    mail_utf8($email, $subject, $message, $bcc);
                    throw new Exception("MySql Error: " . $getImgSet . "<br>" . $conn->error);
                }
                $index++;
            }
        }
    } else {
        throw new Exception("MySql Error: " . $getOfferDetails . "<br>" . $conn->error);
    }
} catch (Exception $e) {
    echo $e->getMessage();
} 