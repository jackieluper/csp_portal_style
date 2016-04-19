<!--
Author: Jason B. Smith
Date: 3/21/16
Managed Solution
-->
<?php
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
    <script src="../../js/loading.js"></script>
    <script src='../../js/main.js'></script>
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
                <li><img class='icon' src='../img/icons/software.png' alt='Products' ><a href='../portal/products.php'>Products</a><br></li>
                <li><img class='icon' src='../img/icons/subscriptions.png' alt='Manage Subscription'><a href="../portal/manageSubscription.php">Manage Licenses</a><br></li>
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
                <h2>Invoice's</h2>
            </div>       
            <form method="post" action="displayInvoice.php">
                <table class="adminTable" id="adminTable">
                    <tr class="ui-widget-header ">
                        <th>Order #</th>
                        <th>Total Amount</th>                        
                        <th>Display Invoice</th>
                    </tr>
                    <?php
                    for ($i = 0; $i < count($invoice->invoiceTranId); $i++) {
                        ?>
                        <tr>
                            <td><?php echo $invoice->invoiceTranId[$i] ?></td>
                            <td >$<?php echo number_format($invoice->invoiceTotal[$i], 2) ?></td>                            
                            <td><button class="invoiceButton" type="submit" name="invoiceId" value=<?php echo $invoice->invoiceTranId[$i] ?> id="submit">Display Invoice</button></td>                 
                        </tr>
                    <?php } ?>
                </table>
            </form>
        </div>
    </div>
    <div id="loading"></div>


