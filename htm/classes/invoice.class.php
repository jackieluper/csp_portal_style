<!--
Author: Jason B. Smith
Date: 3/21/16
Managed Solution
-->
<?php

class invoice{
    function setInvoiceTotal($index, $tranTotal) {
        $this->invoiceTotal[$index] = $tranTotal;
    }
    function getInvoiceTotal() {
        return $this->invoiceTotal;
    }
    function setInvoiceTranId($index, $tranId){
        $this->invoiceTranId[$index] = $tranId;
    }
    function getInvoiceTranId(){
        return $this->invoiceTranId;
    }
}

class invoiceReceipt{
     function setInvoiceTotal($tranTotal) {
        $this->invoiceTotal = $tranTotal;
    }
    function getInvoiceTotal() {
        return $this->invoiceTotal;
    }
    function setDiscountRate($discount){
        $this->discountRate = $discount;
    }
    function getDiscountRate(){
        return $this->discountRate;
    }
    function setTotalSavings($totalSavings){
        $this->totalSavings = $totalSavings;
    }
    function getTotalSavings(){
        return $this->totalSavings;
    }
    function setSubscriptionId($index, $subscriptionId){
        $this->subscriptionId[$index] = $subscriptionId;
    }
    function getSubscriptionId(){
        return $this->subscriptionId;
    }
    function setItemNum($index, $itemNum){
        $this->itemNum[$index] = $itemNum;
    }
    function getItemNum(){
        return $this->itemNum;
    }
    function setProductName($index, $productName){
        $this->productName[$index] = $productName;
    }
    function getProductName(){
        return $this->productName;
    }
    function setSubscriptionLength($index, $subscriptionLength){
        $this->subscriptionLenght[$index] = $subscriptionLength;
    }
    function getSubscriptionLength(){
        return $this->subscriptionLength;
    }
    function setProductCost($index, $productCost){
        $this->productCost[$index] = $productCost;
    }
    function getProductCost(){
        return $this->productCost;
    }
    function setProductQty($index, $qty){
        $this->productQty[$index] = $qty;
    }
    function getProductQty(){
        return $this->productQty;
    }
}

