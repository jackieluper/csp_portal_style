<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
$servername = "localhost";
$username = "root";
$password = "Lgv98011*%";
$dbname = "discount_estimates";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

