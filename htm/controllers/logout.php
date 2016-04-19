<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
require("config.php");
session_start();
//Removes everything from cart on sign out
$sql = "DELETE from cart";
$result = $conn->query($sql);
//If succesful do nothing
if ($conn->query($sql) === TRUE) {
    
}
//Errors out if does not remove cart items
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
//Error reporting
error_reporting(0);
ob_start("ob_gzhandler");
$_SESSION['userSession'] = '';
//Destroys session data
if (session_destroy()) {
    unset($_SESSION['userSession']);
    $index = $base_url . '../../index.php';
    header("Location: $index");
    echo "<script>window.location='index.php'</script>";
}
//closes connection if still open
$conn->close();
?>