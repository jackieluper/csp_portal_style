<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
//db config file
require("config.php");
session_start();
//getting item id to be removed from cart
$item = $_GET['id'];
echo 'ITEM IS:' . $item;
//deletes from cart
$sql = "DELETE FROM cart WHERE items='" . $item . "'";
//if: success else: error
if ($conn->query($sql) === TRUE) {
    header('Location: ../portal/products.phtml');
} else {
    echo "Error deleting record: " . $conn->error;
}
?>