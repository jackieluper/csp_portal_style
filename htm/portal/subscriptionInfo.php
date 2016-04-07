<?php
session_start();
require "../controllers/config.php";
require "../api/client/_init.php";

$customerTenantId = $_SESSION['tid'];
$subscription = new Subscription($customerTenantId);
$subscriptionList = $subscription->getSubscriptionList();
$i = $_POST['itemNum'];
?>
<head>
    <title>My Subscriptions</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>      
    <link href="../../css/styles.css" type="text/css" rel="stylesheet"/>
    <script src='../../js/ms-style-menu.js'></script>
    <script src='../../js/ms-style-cart.js'></script>
    <script src='../../js/main.js'></script>
</head>
<div id="horizontalNav">
    <div id="horizontalNavWrapper">
        <ul>
            <li><?php echo $subscriptionList[$i]->getFriendlyName() ?></li>
        </ul>
    </div>
</div>
<nav class="menu">
    <a href="#" class="nav-toggle-btn">Menu</a>
    <ul>
        <?php if ($_SESSION['role'] >= $userRole) { ?>
            <li><img class='icon' src='../img/icons/software.png' alt='Products' ><a href='../portal/products.php'>Products</a><br></li>
            <li><img class='icon' src='../img/icons/software.png' alt='Manage Subscription'><a href="../portal/manageSubscription.php">Manage Subscriptions</a><br></li>
            <li><img class='icon' src='../img/icons/invoice.jpg' alt='Invoice'><a href='../portal/invoice.php'>Invoice</a><br></li>
            <li><img class='icon' src='../img/icons/checkout.png' alt='Checkout' ><a href='../portal/checkout.php'>Checkout</a><br></li>
            <li><img class='icon' src='../img/icons/home.png' alt='Home' ><a href='<?php echo $homePage ?>'><?php echo $companyName ?></a><br></li>
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
<div class="contentCheckout" style="margin-left: 250px">
    <h3><?php echo $subscriptionList[$i]->getFriendlyName() ?></h3>
    <div><?php echo $subscriptionList[$i]->getEffectiveStartDate()?></div>
    <div><?php echo $subscriptionList[$i]->getCommitmentEndDate()?></div>
    <div><?php echo $subscriptionList[$i]->getStatus() ?></div>
    <div><?php echo $subscriptionList[$i]->getQuantity() ?></div>
    <div><?php echo $subscriptionList[$i]->getAttributes() ?></div>
</div>