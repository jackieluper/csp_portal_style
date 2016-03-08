<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
require("config.php");
session_start();

$sql = "DELETE from cart";
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
   
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

error_reporting(0);
ob_start("ob_gzhandler");
$_SESSION['userSession'] = '';
if (session_destroy()) {
    unset($_SESSION['userSession']);
    $index = $base_url . '../../index.php';
    header("Location: $index");
echo "<script>window.location='index.php'</script>";
}
$conn->close();
?>