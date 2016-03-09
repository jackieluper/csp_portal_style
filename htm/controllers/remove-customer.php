<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
//db config file
require("config.php");
session_start();
//gets customer id
$custID = $_GET['id'];
//deletes customer by setting to active to 0 meaning inactive customer
$sql = "UPDATE customer set active='0' WHERE id='" . $custID . "'";
$result = $conn->query($sql);
if ($conn->query($sql) === TRUE) {
    header('Location: ../portal/admin.phtml');
} else {
    echo "Error updating record: " . $conn->error;
}
?>
