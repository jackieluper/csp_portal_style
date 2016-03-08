<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
session_start();

//grabbing the login userID and setting it to username for session
   $_SESSION['username'] = $_POST['userId'];

     header('refresh:0; url=../portal/products.phtml');
?>