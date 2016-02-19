<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
session_start();
   
   $_SESSION['user']=$_GET['userID'];
   echo "UserID is: ". $_SESSION['user'];
   
  header( "Refresh:2; url=../../htm/api/token.php", true, 303);
?>