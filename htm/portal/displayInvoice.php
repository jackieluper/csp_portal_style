<!--
Author: Jason B. Smith
Date: 3/21/16
Managed Solution
-->
<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
require("../controllers/config.php");
include '../controllers/displayInvoice.db.php';
if (isset($_SESSION['invoiceId'])) {
    $invoiceId = $_SESSION['invoiceId'];
} else {
    $invoiceId = $_POST['invoiceId'];
}
?>
<head>
    <title>Display Invoice</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
    <link href="../../css/styles.css" type="text/css" rel="stylesheet"/>
    <script src='../lib/ms-style-menu.js'></script>
    <script src="../../js/main.js"></script>
</head>
<body>
    <div id="horizontalNav">
        <div id="horizontalNavWrapper">
            <ul>
                <li>Display Invoice</li>
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
        <div class="content">
            <div class="page-header">            
                <h2>Invoice #<?php echo $invoiceId ?></h2>
            </div>

            <div class="invoiceContent">
                <div id="print-content">
                    <div ><img class='invoiceLogo' src="../img/MS_Logo_orange_small.png" alt=<?php echo $companyName ?> ></div>
                    <div style="font-size: 24px;"><strong>Order ID: <?php echo $invoiceId ?> </strong></div><br>
                    <?php
                    for ($i = 0; $i < count($invoiceReceipt->getSubscriptionId()); $i++) {
                        ?>
                        <div style="font-size: 20px; "><strong>Item Number: <?php echo $invoiceReceipt->itemNum[$i] ?></strong></div>
                        <div> --------------</div>
                        <div><strong>Product Name: </strong><?php echo $invoiceReceipt->productName[$i] ?></div>
                        <div><strong>Product ID: </strong><?php echo $invoiceReceipt->subscriptionId[$i] ?></div>
                        <div><strong>Subscription Length: </strong>1 Month(s) </div>
                        <div><strong>Product Cost: </strong>$<?php echo number_format($invoiceReceipt->productCost[$i], 2) ?></div>
                        <div><strong>Product Quantity: </strong><?php echo number_format($invoiceReceipt->productQty[$i], 0) ?></div><br>
                    <?php } ?>
                    <div><strong>Discount Rate: </strong><?php echo number_format($invoiceReceipt->discountRate, 2) ?>%</div>
                    <div><strong>Total Savings: </strong>$<?php echo number_format($invoiceReceipt->totalSavings, 2) ?></div>
                    <div><strong>Sale Total: </strong>$<?php echo number_format($invoiceReceipt->invoiceTotal, 2) ?></div> <br> 
                    <div><input type="button" class="receiptBtn" onclick="printDiv('print-content')" value="Print Receipt"/></div>
                </div>
            </div>
        </div>
    </div>
    <div id="loading"></div>
    <script type="text/javascript">
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
