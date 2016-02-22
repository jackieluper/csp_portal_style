<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
require_once('../api/token.php');

//grabbing the login userID and setting it to username for session
if (isset($_POST['userID'])) {
    $_SESSION['username'] = $_POST['userID'];

    header("Refresh:0; url=../portal/products.phtml", true, 303);
}

?>