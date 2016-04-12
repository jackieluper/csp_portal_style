<?php
session_start();
require("../controllers/config.php");
include '../controllers/cart.db.php';

$role = $_SESSION['role'];
?>
<head>
    <title>Checkout</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href="../../css/styles.css" type="text/css" rel="stylesheet"/>
    <script src='../../js/ms-style-menu.js'></script> 
    <script src="../../js/loading.js"></script>
</head>
<div id="horizontalNav">
    <div id="horizontalNavWrapper">
        <ul>
            <li>Checkout</li>
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
<div id="page">
    <div class="contentCheckout">
        <div class="page-header">
            <h2>CHECKOUT</h2>
        </div>
        <table class="ui-widget ui-widget-content" id='checkoutTable'>
            <thead>
                <tr class="ui-widget-header ">
                    <th>Item</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Update QTy</th>
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
                        <td><input step="1" name="qty" value="<?php echo $cart->qty[$i] ?>" style="text-align: right; border-style: none; border-radius: 5px; width: 10%;"></input></td>
                        <td ><a href="../controllers/remove-from-checkout.php?id=<?php echo $cart->item[$i] ?>" ><strong>Delete</strong></a></td>
                    </tr>            
                <?php } 
                if($cart->discount > 0.00){?>
                <tr>
                    <td class="total" colspan="3" style="border: none; border-collapse: collapse; background-color: #fff; text-align: right; color: #000; font-weight: bold; font-size: 20px;">Discount Savings:</td>
                    <td class="total" colspan="1" style="background-color: #65B1E4">$<?php echo number_format($cart->discount, 2) ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td class="total" colspan="3" style="border: none; border-collapse: collapse; background-color: #fff; text-align: right; color: #000; font-weight: bold; font-size: 20px;">Total Price:</td>
                    <td colspan="1" style="background-color: #65B1E4">$<?php echo number_format($cart->total, 2) ?></td>
                <tr>
                    <td colspan="4" style="border: none; border-collapse: collapse; background-color: #fff; text-align: right"><a href="billing.php"><button type="button" class="checkoutButton">Checkout</button></a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div id="loading"></div>
