<!--
Author: Jason B. Smith
Date: 2/09/16
Managed Solution
-->
<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
require "../controllers/config.php";
require '../controllers/products.db.php';
require '../controllers/cart.db.php';
?>
<head>
    <title>Products</title>
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
            <li>Product Catalog</li>
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
<nav class="sidecart">
    <a href="#" class="cart-toggle-btn">Cart</a>
    <table class="cartTable" >
        <thead>
            <tr class="ui-widget-header ">
                <th>Item</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < count($cart->name); $i++) {
                ?>
                <tr>
                    <td><span><?php echo $cart->name[$i] ?></span></td>
                    <td><?php echo $cart->msrp[$i] ?></td>
                    <td ><?php echo $cart->qty[$i] ?></td>
                    <td><a href="../controllers/remove-from-cart.php?id=<?php echo $cart->item[$i] ?>">Delete</a></td>
                </tr>
            <?php } ?>
                <tr>
                    <td colspan="2"><strong>Discount Amount</strong></td>
                    <td colspan="2"><?php echo number_format($cart->discount, 2)?></td>
                </tr>
            <tr>
                <td colspan="2"><strong>TOTAL</strong></td>
                <td colspan="2"><?php echo number_format($cart->total, 2) ?></td>
            </tr>
        </tbody>
        <tr>
            <td colspan="4"><a href="checkout.php"><button type="button" class="checkoutButton">Checkout</button></a></td>
        </tr>
    </table>
</nav>
<div class="content">
    <div class="page-header">
        <h2>TOP OFFERS <small>Welcome 
                <?php echo $_SESSION['user']; ?>
            </small></h2>
    </div>
    <table class="topOffers" >
        <tr>
            <?php
            for ($i = 0; $i < count($topOffers->name); $i++) {
                ?>
                <td><img width="200px" height="200px"  src="../img/products/officeE3.png" alt="Office 365 E3" ><br><br>
                    <strong><?php echo $topOffers->name[$i] ?> </strong><br>
                    <strong>$<?php echo number_format($topOffers->price[$i], 2) ?></strong><br>
                    <a style="color: #D7D7D7;" href="../controllers/add-to-cart.php?id=<?php echo $topOffers->id[$i] ?>">Add to Cart</a>
                </td>
            <?php } ?>
        </tr>
    </table>
    <div class="page-header">
        <h2>CATALOG</h2>
    </div>
    <table class="catalog" >
        <?php
        for ($i = 0; $i < count($offers->name); $i++) {
            ?>
            <tr>
                <th><?php echo $offers->name[$i] ?></th>
                <td><?php echo number_format($offers->price[$i], 2) ?></td>
                <td><?php echo $offers->unit[$i] ?><td>
                <td><a style="color: #D7D7D7;" href="../controllers/add-to-cart.php?id=<?php echo $offers->id[$i] ?>">Add to Cart</a></td>
            </tr>
        <?php } ?>
    </table>
</div>