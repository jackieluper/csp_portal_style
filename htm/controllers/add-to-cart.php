<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
require("config.php");
session_start();

$offerID = $_GET['id'];

$sql = "SELECT customer_id from user WHERE username='".$_SESSION['user']."'";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){        
        $custID = $row['customer_id'];        
        echo $custID, ' ', "<br>";
    }
}

$sql1 = "SELECT list_price, erp_price from price WHERE offer_id='".$offerID."'";
$result1 = $conn->query($sql1);

if($result1->num_rows > 0){
    while($row = $result1->fetch_assoc()){        
       $listPrice = $row['list_price'];
       $erpPrice = $row['erp_price'];
       echo $listPrice, " ", $erpPrice, "<br>";
    }
}

$sql3 = "SELECT qty from cart where items='".$offerID."'";
$result3 = $conn->query($sql3);


$sql2 = "INSERT INTO cart (customer_id, items, our_cost, msrp, proposed_cost, qty) 
VALUES ('$custID', '$offerID', '$listPrice', '$erpPrice', '$erpPrice', '1')" or die(mysql_error());

if($result3->num_rows > 0){
    while($row = $result3->fetch_assoc()){        
       $qty = $row['qty'] + 1;
       $sql4 = "UPDATE cart SET qty='".$qty."' where items='".$offerID."'";
       if ($conn->query($sql4) === TRUE) {
             header('Location: ../portal/products.htm');
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}
else if($conn->query($sql2) === TRUE){
    echo 'New record created successfully';
    header('Location: ../portal/products.htm');
}
else{
    echo "Error: " .$sql2 . "<br>". $conn->error;
}

$conn->close();
?>