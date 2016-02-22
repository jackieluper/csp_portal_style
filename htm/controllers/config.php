<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
$servername = "localhost";
$username = "root";
$password = "Ltd6530*%";
$dbname = "discount_estimates";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    echo 'success!';
}
?>

