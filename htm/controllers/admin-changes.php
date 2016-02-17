<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
require("config.php");
session_start();

$custID = $_POST['custID'];
$provision = $_POST['provision'];
$discount = $_POST['discount'];

if(strtoupper($provision)=== 'Y'){
    $provision = '1';
}
else if(strtoupper($provision)=== 'N'){
    $provision = '0';
}
else{
    echo 'bad';
}
$sql = "UPDATE customer set is_provised='".$provision."', discount='".$discount."' WHERE id='".$custID."'";
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
             header('Location: ../portal/admin.htm');
        } else {
            echo "Error updating record: " . $conn->error;
        }
?>