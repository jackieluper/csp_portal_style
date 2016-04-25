<?php
require "../controllers/manage-subscriptions.php";
?>
<head>
    <title>My Subscriptions</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="180;url=http://www.msolcsptest.com/htm/controllers/logout.php" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <link href="../../css/styles.css" type="text/css" rel="stylesheet"/>
    <script src='../../js/ms-style-menu.js'></script>
    <script src='../../js/ms-style-cart.js'></script>
    <script src="../../js/loading.js"></script>
    <script src='../../js/main.js'></script>

</head>
<div id="horizontalNav">
    <div id="horizontalNavWrapper">
        <ul>
            <li>Manage Licenses</li>
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
<div id="loading"></div>
<div id="page">
    <div class="contentWide" style="margin-left: 200px">
        <div class="page-header">            
            <h2>Licenses</h2>
        </div>    
        <table id="checkoutTable" >
            <thead>
                <tr class="ui-widget-header ">
                    <th>Product Name</th>
                    <th>Start Date</th>
                    <th>Qty on Record</th>
                    <th>Manage Subscription</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($subscriptionList); $i++) {
                    ?>
                <form action="subscriptionInfo.php" method="post">
                    <tr>
                        <td><input type="hidden" name="itemNum" value="<?php echo $i ?>" style="background-color: #ED8B22; border: none" ><?php echo $subscriptionList[$i]->getFriendlyName() ?></td>
                        <td style="width: 150px"><?php echo substr($subscriptionList[$i]->getEffectiveStartDate(), 0, 10) ?></td>
                        <td><?php echo $subscriptionList[$i]->getQuantity() ?></td>
                        <td><button class="makeChanges" type="submit">Make Changes</button></td>
                    </tr>
                </form>
        </div>

        <?php
    }
    ?>
</div>
