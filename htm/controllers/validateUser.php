<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
session_start();
   
 if (isset($_POST['Submit'])) {
    $_SESSION['username'] = $_POST['userID'];

    // Use the following code to print out the variables.
    echo 'Session: '.$_SESSION['username'];
    echo '<br>';
    echo 'POST: '.$_POST['userID'];
}

  header( "Refresh:2; url=../../htm/api/tokens.php", true, 303);
?>