<!--
Author: Jason B. Smith
Date: 2/09/16
Managed Solution
-->
<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
require("../controllers/config.php");

$role = $_SESSION['role'];
?>
<head>
    <title>Contact Us</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="180;url=http://www.msolcsptest.com/htm/controllers/logout.php" >
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href="../../css/styles.css" type="text/css" rel="stylesheet"/>
    <script src='../lib/ms-style-menu.js'></script>     
    <script src="../../js/loading.js"></script>
    <script src='../../js/main.js'></script>
</head>
<div id="horizontalNav">
    <div id="horizontalNavWrapper">
        <ul>
            <li>Contact Us</li>
        </ul>
    </div>
</div>
<nav class="menu">
    <a href="#" class="nav-toggle-btn">Menu</a>
    <ul>
        <?php if ($_SESSION['role'] >= $userRole) { ?>
            <li><img class='icon' src='../img/icons/software.png' alt='Products' ><a href='../portal/products.php'>Products</a><br></li>
            <li><img class='icon' src='../img/icons/subscriptions.png' alt='Manage Subscription'><a href="../portal/manageSubscription.php">Manage Licenses</a><br></li>
            <li><img class='icon' src='../img/icons/invoice.jpg' alt='Invoice'><a href='../portal/invoice.php'>Invoice</a><br></li>
            <li><img class='icon' src='../img/icons/checkout.png' alt='Checkout' ><a href='../portal/checkout.php'>Checkout</a><br></li>
            <li><img class='icon' src='../img/icons/home.png' alt='Home' ><a href='<?php echo $homePage ?>'><?php echo $ownerName ?></a><br></li>
            <?php if ($_SESSION['role'] == $adminRole) { ?>
                <li><img class='icon' src='../img/icons/Admin.png' alt='Admin' ><a href='../portal/admin.php'>Administration</a><br></li>
                <?php
            }
        }
        ?>
        <li><img class='icon' src='../img/icons/contact.jpg' alt='Contact' ><a href='../portal/contactUs.php'>Contact us</a><br></li>
        <li><img class='icon' src='../img/icons/logout.png' alt='Logout' ><a href='../controllers/logout.php'>Logout</a><br></li>
    </ul>
</nav>
<div id="page">
    <div class="contactContent"> 
        <table class="contactTbl">
            <tr>
                <th class="cntHeader">Title</th>
                <th class="cntHeader">Name</th>
                <th class="cntHeader">Email Address</th>
                <th class="cntHeader">Phone Number</th>
            </tr>
            <tr>
                <!--Company specific information Change to your company information as to who to contact with issues on your portal -->
                <td class="cntRow1"><strong>Business Operations Manager</strong></td>
                <td class="cntRow1">Jennell Mott</td>
                <td class="cntRow1">JMott@managedsolution.com</td>
                <td class="cntRow1">(858)429-3035 </td>
            </tr>
        </table>
    </div>
</div>
<div id="loading"></div>
