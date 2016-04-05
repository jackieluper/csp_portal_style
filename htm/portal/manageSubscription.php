<?php
session_start();
require "../controllers/config.php";
require "../api/client/_init.php";
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
            <li>Manage Subscriptions</li>
        </ul>
    </div>
</div>
<nav class="menu">
    <a href="#" class="nav-toggle-btn">Menu</a>
    <ul>
        <?php if ($_SESSION['role'] >= $userRole) { ?>
            <li><img class='icon' src='../img/icons/software.png' alt='Products' ><a href='products.php'>Products</a><br></li>
            <li><img class='icon' src='../img/icons/invoice.jpg' alt='Invoice'><a href='invoice.php'>Invoice</a><br></li>
            <li><img class='icon' src='../img/icons/checkout.png' alt='Checkout' ><a href='checkout.php'>Checkout</a><br></li>
            <li><img class='icon' src='../img/icons/home.png' alt='Home' ><a href='<?php echo $homePage ?>'><?php echo $companyName ?></a><br></li>
            <?php if ($_SESSION['role'] == $adminRole) { ?>
                <li><img class='icon' src='../img/icons/Admin.png' alt='Admin' ><a href='admin.php'>Administration</a><br></li>
                <?php
            }
        }
        ?>
        <li><img class='icon' src='../img/icons/contact.jpg' alt='Contact' ><a href='contactUs.php'>Contact us</a><br></li>
        <li><img class='icon' src='../img/icons/logout.png' alt='Logout' ><a href='../controllers/logout.php'>Logout</a><br></li>
    </ul>
</nav>
<div class="contentCheckout" style="margin-left: 200px">
    <?php
    $customerTenantId = $_SESSION['tid'];
//business logic is in just for demo purpose
    $subscription = new Subscription($customerTenantId);
    /* @var Subscription[] $subscriptionList */
    $subscriptionList = $subscription->getSubscriptionList();

    // echo $subscriptionList[$i]->getFriendlyName() . ' ' . $subscriptionList[$i]->getQuantity() . '<br>' ;
    print '<table id="checkoutTable" >
        <thead>
            <tr class="ui-widget-header ">
                <th>Product Name</th>
                <th>Qty</th>
                <th>Update Qty</th>
            </tr>
        </thead>
        <tbody>';
    for ($i = 0; $i < count($subscriptionList); $i++) {
        ?>
    <form action="../controllers/update-qty.php" method="post">
            <tr>
                <td><input type="text" value="<?php echo $subscriptionList[$i]->getFriendlyName() ?>" style="background-color: #ED8B22" ></td>
                <td><input id="qty" name="qty" type="number" step="1" value="<?php echo $subscriptionList[$i]->getQuantity() ?>" style="color: #000"></input></td>
                <td><button class="checkoutButton" type="submit">Update Quantity</button></td>
            </tr>
        </form>
    <?php
    }


//$subscriptionList[0]->updateFriendlyName();
//
//$subscriptionList[0]->getAddOnList();
//$subscriptionList[0]->suspendSubscription();
    ?>