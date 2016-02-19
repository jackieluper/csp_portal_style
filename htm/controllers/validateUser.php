<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
session_start();
header("Location: ../api/token.php");

if (isset($_POST['userID'])) {
    $_SESSION['username'] = $_POST['userID'];

    // Use the following code to print out the variables.
    echo 'Session: ' . $_SESSION['username'];
    echo '<br>';
    echo 'POST: ' . $_POST['userID'];
}
?>