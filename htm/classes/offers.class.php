<!--
Author: Jason B. Smith
Date: 3/21/16
Managed Solution
-->
<?php

class topOffers {

    function setOffer($index, $offer) {
        $this->offer[$index] = $offer;
    }
    function getOffer() {
        return $this->offer;
    }
    function setOfferDetails($index, $name, $price) {
        $this->name[$index] = $name;
        $this->price[$index] = $price;
    }

    function getOfferDetails() {
        return $this->name . '<br>'
                . '$' . number_format($this->price, 2);
    }
    function setOfferId($index, $id){
        $this->id[$index] = $id;
    }
    function getOfferId(){
        $this->id;
    }
     function setOfferImg($index, $tag){
        $this->img_tag[$index] = "../img/microsoft_img/$tag";
    }
    function getOfferImg(){
        $this->img_tag;
    }
    function setOfferCaption($index, $caption){
        $this->caption[$index] = $caption;
    }
    function getOfferCaption(){
        $this->caption;
    }
}

class offers {

    function setOffer($offer) {
        $this->offer[0] = $offer;
    }
    function getOffer() {
        return $this->offer[0];
    }
    function setOfferName($index, $name){
        $this->name[$index] = $name;
    }
    function getOfferName(){
        $this->name;
    }
    function setOfferPrice($index, $price){
        $this->price[$index] = $price;
    }
    function getOfferPrice(){
        $this->price;
    }
    function setOfferUnit($index, $unit){
        $this->unit[$index] = $unit;
    }
    function getOfferUnit(){
        $this->unit;
    }
    function setOfferId($index, $id){
        $this->id[$index] = $id;
    }
    function getOfferId(){
        $this->id;
    }
    function setOfferImg($index, $tag){
        $this->img_tag[$index] = "../img/microsoft_img/$tag";
    }
    function getOfferImg(){
        $this->img_tag;
    }
    function setOfferCaption($index, $caption){
        $this->caption[$index] = $caption;
    }
    function getOfferCaption(){
        $this->caption;
    }
}

    