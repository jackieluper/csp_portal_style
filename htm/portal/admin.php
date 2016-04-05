<!--
Author: Jason B. Smith
Date: 2/09/16
Managed Solution
-->
<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
require "../controllers/config.php";
require '../controllers/admin.db.php';
?>
<head>
    <title>Administration</title>
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
                <li>Administration</li>
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
    <div class="adminContent">
        <div class="page-header">
            <h2>Administration</h2>
        </div>
        <table class="adminTable" id="adminTable">
            <tr class="ui-widget-header ">
                <th>Company Name</th>
                <th>Primary Domain Name</th>
                <th>Relationship</th>
                <th>Allow Provisional Credit</th>
                <th>Discount %</th>
                <th>Remove Customer</th>
                <th>Apply Changes</th>
            </tr>
            <?php
            for ($i = 0; $i < count($admin->custId); $i++) {
                ?>
                <form method="post" action="../controllers/admin-changes.php">
                    <tr>
                        <td ><?php echo $admin->custName[$i] ?></td>
                        <td><?php echo $admin->primDomain[$i] ?></td>
                        <td><?php echo $admin->custRelationship[$i] ?></td>
                        <td><input name="provision" id="provision" color="black" type="text" pattern="[N-Nn-nY-Yy-y]{1}" onkeydown="validateProv(this)" value="<?php echo $admin->provision[$i] ?>" maxlength="1" ></td>
                        <td><input name="discount" id="discount" color="black" type="number" step="0.5" value="<?php echo $admin->discount[$i] ?>" min="0" max="100"></td>
                        <td><a href="../controllers/remove-customer.php?id=<?php echo $admin->custId[$i] ?>" >Delete</a></td>
                        <td><button type="submit" name="custID" value="<?php echo $admin->custId[$i] ?>" class="applyChanges" id="submit">Apply Changes</button></td>                 
                    </tr>
                </form>
            <?php } ?>
        </table>
    </div>
    <!--
        REGEX to make sure the value that the administrator is using is correct Y or N
    -->
    <script type="text/javascript">
        function validateProv() {
            var reg = new RegExp(/[N-Nn-nY-Yy-y]{1}/);
            var provision = $("#provision").val();
            var prov = document.getElementById('provision');

            if (!provision.match(reg)) {
                prov.setCustomValidity("Input can only be Y or N");
            } else {
                prov.setCustomValidity("");
            }
        }
    </script>