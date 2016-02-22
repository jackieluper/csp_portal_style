<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
session_start();


//TODO: MOVE TO TOKEN SO THAT THERE ARE NOT TO MANY REDIRECTS
if (isset($_POST['userID'])) {
    $_SESSION['username'] = $_POST['userID'];

    // Use the following code to print out the variables.
    echo 'Session: ' . $_SESSION['username'];
    echo '<br>';
    echo 'POST: ' . $_POST['userID'];
}
?>