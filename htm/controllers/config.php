<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
$servername = "127.0.0.1";
$username = "root";
$password = "Ltd6530*%";
$dbname = "discount_estimates";
$clientID = "000000004C18315D";
$clientSecret = "keYzWeXn4m8XbZtUKLyuwTp9SskVn3jk";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

