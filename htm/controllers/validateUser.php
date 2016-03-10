<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
session_start();
require 'config.php';
//grabbing the login userID and setting it to username for session
$_SESSION['username'] = $_POST['userId'];

$sql = "SELECT role from user where username='" . $_POST['userid'] . "'";
$result = $conn->query($sql);
if($result->num_rows > 0){
    while ($row = $result->fetch_assoc()) {
        $_SESSION['role'] = $row['role'];
    }
}

header('refresh:0; url=../portal/products.phtml');
?>