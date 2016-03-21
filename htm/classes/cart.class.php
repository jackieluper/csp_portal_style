<!--
Author: Jason B. Smith
Date: 3/21/16
Managed Solution
-->
<?php

class cart {

    function setItem($index, $item) {
        $this->item[$index] = $item;
    }

    function getItem() {
        return $this->item;
    }

    function setName($index, $name) {
        $this->name[$index] = $name;
    }

    function getName() {
        return $this->name;
    }

    function setMsrp($index, $msrp) {
        $this->msrp[$index] = $msrp;
    }

    function getMsrp() {
        return $this->msrp;
    }

    function setQty($index, $qty) {
        $this->qty[$index] = $qty;
    }

    function getQty() {
        return $this->qty;
    }

    function setDiscount( $discount) {
        $this->discount = $discount;
    }

    function getDiscount() {
        return $this->discount;
    }
    function setDiscountRate($rate){
        $this->discountRate = $rate;
    }
    function getDiscountRate(){
        return $this->discountRate;
    }
    function setTotal($total) {
        $this->total = $total;
    }

    function getTotal() {
        return $this->total;
    }

}
