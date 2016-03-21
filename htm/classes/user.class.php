<!--
Author: Jason B. Smith
Date: 3/21/16
Managed Solution
-->
<?php

class user {

    function setUsername($newUser) {
        $this->username = $newUser;
    }

    function getUsername() {
        return $this->username;
    }

//Gets customer ID and sets it to variable and session variable
    function setCustId($custId) {
        $this->custId = $custId;
    }

    function getCustId() {
        return $this->custId;
    }

//Grabs the type of company Corporate/Government for rates and products to be displayed
    function setEntity($entity) {
        $this->entity = $entity;
    }

    function getEntity() {
        return $this->entity;
    }

    function setRole($role) {
        $this->role = $role;
    }

    function getRole() {
        return $this->role;
    }

}
