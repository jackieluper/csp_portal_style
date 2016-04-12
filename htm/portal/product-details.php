<?php
session_start();
require "../controllers/config.php";

$id = $_GET['id'];
$sqlOffer = "SELECT display_name, purchase_unit from offer where id='$id'";
$resOffer = $conn->query($sqlOffer);
if ($resOffer->num_rows > 0) {
    while ($row = $resOffer->fetch_assoc()) {
        $product_name = $row['display_name'];
        $purchase_unit = $row['purchase_unit'];
        echo $product_name;
    }
}
?>
<head>
    <title>Product Details</title>
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
    <div class="subscriptionContent" >
        <?php
        $resultImg = $conn->query("select img_tag, details from image where offer_name='" . $product_name . "'");
        if ($resultImg->num_rows > 0) {
            while ($row = $resultImg->fetch_assoc()) {
                $tag = $row['img_tag'];
                $details = $row['details'];
            }
        } else {
            $tag = "noImage.png";
        }
        ?><div style="margin: 50px 0 0 100px; display: inline-block">
            <image src="../img/microsoft_img/<?php echo $tag ?>" alt="Image not found" >
            <div >
                <table class="subscriptionDetails">
                    <tr>
                        <td class="subscriptionTitle" colspan="3" style="font-size: 22px;"><strong><u><?php echo $product_name ?></u></strong></td>
                    </tr>
                    <form action="../controllers/update-qty.php" method="post">
                        <tr>
                            <td class="subscriptionDetails" ><p><?php echo $details ?></p></td>
                        </tr>
                        <tr>
                            <td class="subscriptionInfo"><input step="1" name="qty" value="" style="border-style: groove; border-radius: 5px; width: 20%;"></input></td>
                            <td style="align-content: left"><button class="updateQtyBtn" type="submit">Update License's</button></td>
                        </tr>

                    </form>
                    <form action="suspendAllLicenses.php">
                        <tr>
                            <td class="subscriptionTitle">Status: </td>
                            <td class="subscriptionInfo"></td>
                            <td style="align-content: left"><button class="updateQtyBtn" type="submit">Suspend All Licenses</button></td>
                        </tr>
                    </form>
                </table>
            </div>            
        </div>
    </div>
</div>
<div id="loading"></div>