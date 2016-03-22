<!--
Author: Jason B. Smith
Date: 2/09/16
Managed Solution
-->
<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if (!empty($_GET['code'])) {
    require_once '../api/client/_init.php';

    $adAuth = new AdAuth();
    $adAuth->requestAdTokenForAuthCode($_GET['code']);

    // FIXME --- remove this debugging code
    var_dump($adAuth->getIdToken());
    die();
    // FIXME --- end of remove this debugging code

    $customer = new Customer();
    $customer->loadCustomerFromIdToken($adAuth->getIdToken());
}
?>
<head>
    <title>Sign-in</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="../../css/styles.css" type="text/css" rel="stylesheet"/>
</head>
<div class="header-white"></div>
<div class="ss-stand-alone">
    <div class="ss-nav">
        <div id="header-wrapper">
            <a class="logohover" href="http://www.managedsolution.com">
                <div class="logo"><img src="../img/MS_Logo_orange.png" alt="MS Logo" style="width: 200px; height: 50px; "></div> 
            </a>
            <!--
            <div id="mainmenu" class="menu-menu-container">
                <ul id="nav" class="nav" style="opacity: 1;"><li id="menu-item-5925" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-5925"><a href="http://jackiewiener.com/ms2/" >Home</a></li>
                    <li id="menu-item-5924" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5924"><a href="http://jackiewiener.com/ms2/about/" >About</a></li>
                    <li id="menu-item-5926" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5926"><a href="http://jackiewiener.com/ms2/we-love-our-team/" >Services</a></li>
                    <li id="menu-item-5927" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5927"><a href="http://jackiewiener.com/ms2/testimonials/" >Testimonials</a></li>
                    <li id="menu-item-5928" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5928"><a href="http://jackiewiener.com/ms2/?page_id=4189" >Contact us!</a></li>
                    <li id="menu-item-5929" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-5929"><a href="http://jackiewiener.com/ms2/uncategorized/immersion/" >Immersion Experience</a></li>
                    <li id="menu-item-5930" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5930"><a href="http://jackiewiener.com/ms2/free-assessment-and-business-outcome-roadmap/" >Free Stuff</a></li>
                </ul>
            </div>
            -->
        </div>
    </div>
    <div class="fullwidthtitle">
        <h1 class="content-title" id="contentTxt">Billing Portal Log-in</h1>
    </div>
    <div id="promoCarousel" class="carousel" data-ride="carousel">

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active" id="item">
                <img src="../img/log-in_page/promo/office365.jpg" alt="Office365" style=" height: 100%;">
                <div class="carousel-caption"  id="imgOverlay">
                    <h3>Office 365</h3>
                    <p>Microsoft Office 365 is a cloud-based service that is designed to help <br>
                        meet your organization’s needs for robust security, reliability, and user productivity.<br>
                        Check out our special pricing.</p>
                </div>
            </div>

            <div class="item" id="item">
                <img src="../img/log-in_page/promo/EMS.jpg" alt="Microsoft EMS"  style="padding-top: 10%;">
                <div class="carousel-caption" id="imgOverlay">
                    <h3 >Microsoft Enterprise Mobility Suite</h3>
                    <p>Keep your employees productive on their favorite apps and devices<br>
                        and your company data protected with enterprise mobility solutions from microsoft<br>
                        Check out our special pricing.</p>
                </div>
            </div>

            <div class="item" id="item">
                <img src="../img/log-in_page/promo/crmOnline.jpg" alt="Microsoft Dynamics"  style=" height: 100%;">
                <div class="carousel-caption"  id="imgOverlay">
                    <h3>Microsoft Dynamics</h3>
                    <p>Grow your business with Microsoft Dynamics.<br> 
                        Sell in the now, increase productivity, win faster and personalize interactions.<br>
                        Check out our special offer.</p>
                </div>
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#promoCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#promoCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
<!--    <form class="form-inline" id="loginForm" action="../controllers/validateUser.php" method="post">-->
<!--        <div class="form-group" >-->
<!--            <label class="lbl">UserName</label>-->
<!--            <input class="form-control" type="text" name="userId" id="userId" placeholder="required" required><br>-->
<!--            <label class="lbl">Password</label>-->
<!--            <input class="form-control" type="password" name="password" placeholder="required" required><br>             -->
<!--            <input class="loginBtn" type="Submit" name="loginBtn" value="Sign-in" ><br>-->
<!--            <a class="link" id="regLink" href="registration.php">Have not registered yet? Click Here!</a>-->
<!--        </div>-->
<!--    </form>  -->
    <div class="login">

        <div class="login-text">Login with your Microsoft Work Account!<br>
            Click the Microsoft button below</div><br>         
        <div><a href="https://managedsolutionacs.accesscontrol.windows.net:443/v2/wsfederation?wa=wsignin1.0&wtrealm=http%3a%2f%2fbilling.managedsolution.com"><input class="loginBtn" type="image" name="login-image" src="../img/log-in_page/microsoft_logo.png" ></a></div><br>
        <a class="link" id="regLink" href="registration.php">Have not registered yet? Click Here!</a>
    </div>
</div>

