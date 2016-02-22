<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
$servername = "104.40.59.186";
$username = "root";
$password = "Ltd6530*%";
$dbname = "discount_estimates";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

