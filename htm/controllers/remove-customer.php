<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
require("config.php");
session_start();
$custID = $_GET['id'];

echo $custID;


$sql = "UPDATE customer set active='0' WHERE id='".$custID."'";
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
             header('Location: ../portal/admin.phtml');
        } else {
            echo "Error updating record: " . $conn->error;
        }

?>
