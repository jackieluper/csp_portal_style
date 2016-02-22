<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
//db config file must have
require("config.php");
session_start();

//grabs id from the item selected to be removed
$item = $_GET['id'];
//deletes the specified offer from cart and all qnties
$sql = "DELETE FROM cart WHERE items='".$item."'";
//if success or else error
if ($conn->query($sql) === TRUE) {
    header('Location: ../portal/checkout.phtml');
} else {
    echo "Error deleting record: " . $conn->error;
}
?>