<?php
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
    <script src="../../js/loading.js"></script>
    <script src='../../js/main.js'></script>
</head>
<body>
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

        <div class="wrapOffers" style="width: 100%; margin-left: 90px">
            <?php
            for ($i = 0; $i < count($topOffers->name); $i++) {
                ?>
                <!--table works finish adding qty, then check that add to cart works with qty and then do same to catalog offers -->

                <table  width="8%" style="display: inline-block">
                    <form action="../controllers/add-to-cart.php" method="post">
                        <tr>
                            <td><strong> <?php echo $topOffers->name[$i] ?> </strong></td>
                        </tr>                                                
                        <tr>
                            <td><div class="item active" id="item"><image class="productImage" src="<?php echo $topOffers->img_tag[$i] ?>" alt="Image not found"></div></td>
                        </tr>
                        <tr>
                            <td><strong> $<?php echo number_format($topOffers->price[$i], 2) ?>  <?php echo $offers->unit[$i] ?> </strong></td>
                        </tr>
                        <tr>
                            <td><strong><a style="color: #258ED9;" href="../portal/product-details.php?id=<?php echo $topOffers->id[$i] ?>">More details</a></strong></td>
                        </tr>
                        <tr>                            
                            <td><strong><input step="1" name="qty" value="1" style="text-align: right; border-style: groove; border-radius: 5px; width: 20%;"></input><input type="hidden" name="id" value="<?php echo $topOffers->id[$i] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><strong><button class="updateQtyBtn" type="submit">Add To Cart</button></strong></td>
                                    </tr>
                    </form>
                </table>

            <?php } ?>
        </div>

        <div class="page-header">
            <h2>CATALOG</h2>
        </div>
        <div class="wrapOffers" style="width: 100%; margin-left: 90px">
            <?php
            for ($i = 0; $i < count($offers->name); $i++) {
                ?>
                <table  width="8%" style="display: inline-block">
                    <form action="../controllers/add-to-cart.php" method="post">
                        <tr>
                            <td><strong> <?php echo $offers->name[$i] ?> </strong></td>
                        </tr>                                                
                        <tr>
                            <td><div class="item active" id="item"><image class="productImage" src="<?php echo $offers->img_tag[$i] ?>" alt="Image not found"></div></td>
                        </tr>
                        <tr>
                            <td><strong> $<?php echo number_format($offers->price[$i], 2) ?>  <?php echo $offers->unit[$i] ?> </strong></td>
                        </tr>
                        <tr>
                            <td><strong><a style="color: #258ED9;" href="../portal/product-details.php?id=<?php echo $offers->id[$i] ?>">More details</a></strong></td>
                        </tr>
                        <tr>                            
                            <td><strong><input step="1" name="qty" value="1" style="text-align: right; border-style: groove; border-radius: 5px; width: 20%;"></input><input type="hidden" name="id" value="<?php echo $offers->id[$i] ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><strong><button class="updateQtyBtn" type="submit">Add To Cart</button></strong></td>
                                    </tr>
                    </form>
                <?php } ?>

            </table>
        </div>
    </div>
</div>
</body>
<div id="loading"></div>
