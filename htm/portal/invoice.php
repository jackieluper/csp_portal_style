<!--
Author: Jason B. Smith
Date: 3/21/16
Managed Solution
-->
<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include '../controllers/invoice.db.php';
?>
<head>
    <title>Invoice's</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
    <link href="../../css/styles.css" type="text/css" rel="stylesheet"/>
    <script src='../lib/ms-style-menu.js'></script>     
</head>
<body>
    <div id="horizontalNav">
        <div id="horizontalNavWrapper">
            <ul>
                <li>Invoice's</li>
            </ul>
        </div>
    </div>
    <nav class="menu">
        <a href="#" class="nav-toggle-btn">Menu</a>
        <ul>
            <?php if ($_SESSION['role'] >= $userRole) { ?>
                <li><img class='icon' src='../img/icons/software.png' alt='Products' ><a href='products.php'>Products</a><br></li>
                <li><img class='icon' src='../img/icons/software.png' alt='Manage Subscription'><a href="manageSubscription.php">Manage Subscriptions</a><br></li>
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
    <div class="content">
        <div class="page-header">            
            <h2>Invoice's</h2>
        </div>       
        <form method="post" action="displayInvoice.php">
            <table class="adminTable" id="adminTable">
                <tr class="ui-widget-header ">
                    <th>Total Amount</th>
                    <th>Transaction ID</th>
                    <th>Display Invoice</th>
                </tr>
                <?php
                for ($i = 0; $i < count($invoice->invoiceTotal); $i++) {
                    ?>
                    <tr>
                        <td >$<?php echo number_format($invoice->invoiceTotal[$i], 2) ?></td>
                        <td><?php echo $invoice->invoiceTranId[$i] ?></td>
                        <td><button class="invoiceButton" type="submit" name="invoiceId" value=<?php echo $invoice->invoiceTranId[$i] ?> id="submit">Display Invoice</button></td>                 
                    </tr>
                <?php } ?>
            </table>
        </form>
    </div>


