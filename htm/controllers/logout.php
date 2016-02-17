<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php


    session_start();
    session_unset();
    session_destroy();
    
    header("Location: ../../htm/portal/login_page.htm");
?>