<!--
Author: Jason B. Smith
Date: 3/21/16
Managed Solution
-->
<?php
class admin {

    function setCustId($index, $custId) {
        $this->custId[$index] = $custId;
    }

    function getCustId() {
        return $this->custId;
    }
    function setDiscount($index, $discount){
        $this->discount[$index] = $discount;
    }
    function getDiscount(){
        return $this->discount;
    }
    function setCustName($index, $custName){
        $this->custName[$index] = $custName;
    }
    function getCustName(){
        return $this->custName;
    }
    function setPrimDomain($index, $primDomain){
        $this->primDomain[$index] = $primDomain;
    }
    function getPrimDomain(){
        return $this->primDomain;
    }
    function setCustRelationship($index, $custRelationship){
        $this->custRelationship[$index] = $custRelationship;
    }
    function getCustRelationship(){
        return $this->custRelationship;
    }
    function setProvision($index, $provision){
        $this->provision[$index] = $provision;
    }
    function getProvision(){
        return $this->provision;
    }
}
