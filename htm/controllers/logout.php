<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
    //TODO: delete everything from cart when they logout
    require("config.php");
    session_start();
    session_unset();
    session_destroy();
    
    $sql = "DELETE from cart";
    $result = $conn->query($sql);
    
    if($conn->query($sql) === TRUE){
    echo 'New record created successfully';
     header("Location: ../../htm/portal/login_page.htm");
    }
    else{
        echo "Error: " .$sql . "<br>". $conn->error;
    }

$conn->close();
?>