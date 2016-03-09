<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
require("config.php");
session_start();
//customer id of user logged in
$custID = $_POST['custID'];
//provision = can the customer proceed with out billing info
$provision = $_POST['provision'];
//discount= how much we are discounting this client off msrp
$discount = $_POST['discount'];
//Y,y,N,n only acceptable forms and translates 1 as provisioned 0 is not provisioned
if(strtoupper($provision)=== 'Y'){
    $provision = '1';
}
else if(strtoupper($provision)=== 'N'){
    $provision = '0';
}
else{
    echo 'bad';
}
//updates changes made by administrators
$sql = "UPDATE customer set is_provised='".$provision."', discount='".$discount."' WHERE id='".$custID."'";
$result = $conn->query($sql);

if ($conn->query($sql) === TRUE) {
             header('Location: ../portal/admin.phtml');
        } else {
            echo "Error updating record: " . $conn->error;
        }
//close DB connection
$conn->close();
?>