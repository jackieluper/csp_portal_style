<?php
session_start();
require "../controllers/config.php";
require "../api/client/_init.php";

$customerTenantId = $_SESSION['tid'];
$subscription = new Subscription($customerTenantId);
$subscriptionList = $subscription->getSubscriptionList();
$i = $_POST['itemNum'];
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
            <li><?php echo $subscriptionList[$i]->getFriendlyName() ?></li>
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
<div class="subscriptionContent" >
    <?php
    $resultImg = $conn->query("select img_tag, details from image where offer_name='" . $subscriptionList[$i]->getOfferName() . "'");
    if ($resultImg->num_rows > 0) {
        while ($row = $resultImg->fetch_assoc()) {
            $tag = $row['img_tag'];
            $details = $row['details'];
        }
    } else {
        $tag = "noImage.png";
    }
    ?><div style="margin: 50px 0 0 100px">
        <image src="../img/microsoft_img/<?php echo $tag ?>" alt="Image not found" >
        <div style="float:right">
            <table class="subscriptionDetails">
                <th class="subscriptionHeader" colspan="2"><?php echo $subscriptionList[$i]->getOfferName() ?></th>
                <tr>
                    <td class="subscriptionTitle">Effective start date: </td>
                    <td class="subscriptionInfo"><?php echo substr($subscriptionList[$i]->getEffectiveStartDate(), 0, 10) ?></td>
                </tr>
                <tr>
                    <td class="subscriptionTitle">Commitment end date: </td>
                    <td class="subscriptionInfo"><?php echo substr($subscriptionList[$i]->getCommitmentEndDate(), 0, 10) ?></td>
                </tr>
                <form action="updateQty.php" method="post">
                    <tr>
                        <td class="subscriptionTitle">Quantity on record: </td>
                        <td class="subscriptionInfo"><input step="1" value="<?php echo $subscriptionList[$i]->getQuantity() ?>" style="border: none; width: 10%"></input></td>
                        <td style="align-content: left"><button class="updateQtyBtn" type="submit">Add/Remove</button></td>

                    </tr>
                </form>
                <form action="suspendAllLicenses.php">
                    <tr>
                        <td class="subscriptionTitle">Status: </td>
                        <td class="subscriptionInfo"><?php echo $subscriptionList[$i]->getStatus() ?></td>
                        <td style="align-content: left"><button class="updateQtyBtn" type="submit">Suspend All Licenses</button></td>
                    </tr>
                </form>
            </table>
        </div>
        <div class="subscriptionCaption"><?php echo $details ?></div>
    </div>
</div>