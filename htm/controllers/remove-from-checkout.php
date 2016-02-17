<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
require("config.php");
session_start();

$item = $_GET['id'];
echo $item;

$sql = "DELETE FROM cart WHERE items='".$item."'";

if ($conn->query($sql) === TRUE) {
    header('Location: ../portal/checkout.htm');
} else {
    echo "Error deleting record: " . $conn->error;
}
?>