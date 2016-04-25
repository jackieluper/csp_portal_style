<?php
require '../controllers/product-details-db.php';
?>
<head>
    <title>Product Details</title>
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
            <li><?php echo $product_name ?></li>
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
    <div class="subscriptionContent" >
        <div style="margin: 50px 0 0 100px; display: inline-block">
            <image src="../img/microsoft_img/<?php echo $tag ?>" alt="Image not found" style="float:left">
            <table class="subscriptionDetails" style="width: 60%; float: right">
                <tr>
                    <td class="subscriptionTitle"  style="font-size: 24px; text-align:center" colspan="3"><strong><u><?php echo $product_name ?></u></strong></td>
                </tr>
                <form action="../controllers/add-to-cart.php" method="post">
                    <tr>
                        <td class="subscriptionDetails" style="font-size: 22px; text-align:center" colspan="3" ><p><?php echo $details ?></p></td>
                    </tr>
                    <tr>
                        <td class="subscriptionDetails" style="font-size: 16px; text-align:center" colspan="3" ><strong>$<?php echo number_format($price, 2) ?> per <?php echo $purchase_unit ?></strong></td>
                    </tr>
                    <tr>
                        <td class="subscriptionInfo" colspan="3" style="text-align: center"><input type="hidden" name="id" value="<?php echo $id ?>"><strong>Quantity: </strong><input type="number" step="1" name="qty" value="1" style="border-style: groove; border-radius: 5px; width: 10%; text-align: right;"></input></td>
                    </tr>
                    <tr>
                        <td style="align-content: left"><button class="updateQtyBtn" type="submit">Add To Cart</button></td>
                    </tr>


                </form>
            </table>
        </div>            
    </div>
</div>

<div id="loading"></div>