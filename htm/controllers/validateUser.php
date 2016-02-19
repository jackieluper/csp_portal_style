<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
session_start();
header("Refresh:2; url=../htm/api/token.php", true, 303);

if (isset($_POST['userID'])) {
    $_SESSION['username'] = $_POST['userID'];

    // Use the following code to print out the variables.
    echo 'Session: ' . $_SESSION['username'];
    echo '<br>';
    echo 'POST: ' . $_POST['userID'];
}
?>