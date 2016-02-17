<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php

session_start();

var_dump($_SESSION['cart']);

$whereIn = implode(' ', $_SESSION['cart']);

$sql = " SELECT * FROM products WHERE id IN ($whereIn)";

echo $sql;
?>
