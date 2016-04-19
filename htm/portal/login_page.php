<!--
Author: Jason B. Smith
Date: 2/09/16
Managed Solution
-->
<?php
require_once '../api/client/_init.php';

if (!empty($_GET['code'])) {
    var_dump($_GET['code']);
    die();

    $adAuth = new AdAuth();
    $adAuth->requestAdTokenForAuthCode($_GET['code']);

    $customer = new Customer();
    $customer->loadCustomerFromIdToken($adAuth->getIdToken());
}
?>
<html>
    <head>
        <title>Sign-in</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../../css/styles.css" type="text/css" rel="stylesheet"/>
        <script src="http://code.jquery.com/jquery-1.12.2.min.js"
        integrity="sha256-lZFHibXzMHo3GGeehn1hudTAP3Sc0uKXBXAzHX1sjtk=" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
                integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="header-white"></div>
        <div class="ss-stand-alone">
            <div class="ss-nav">
                <div id="header-wrapper">
                    <a class="logohover" href="http://www.managedsolution.com">
                        <div class="logo"><img src="../img/MS_Logo_orange.png" alt="MS Logo"
                                               style="width: 200px; height: 50px; "></div>
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
                        <img src="../img/microsoft_img/office_365_e3.jpg" alt="Office365" style=" height: 100%;">
                        <div class="carousel-caption" id="imgOverlay">
                            <h3>Office 365</h3>
                            <p>The best plan for businesses that need full productivity, communication and collaboration <br>
                                tools with the familiar Office suit; including Office Online.<br></p>
                        </div>
                    </div>

                    <div class="item" id="item">
                        <img src="../img/microsoft_img/enterprise_mobility_suite.jpg" alt="Microsoft EMS" style="height: 100%;">
                        <div class="carousel-caption" id="imgOverlay">
                            <h3>Microsoft Enterprise Mobility Suite</h3>
                            <p>Keep your employees productive on their favorite apps and devices<br>
                                and your company data protected with enterprise mobility solutions from microsoft<br>
                                Check out our special pricing.</p>
                        </div>
                    </div>

                    <div class="item" id="item">
                        <img src="../img/microsoft_img/microsoft_dynamics_crm.jpg" alt="Microsoft Dynamics" style=" height: 100%;">
                        <div class="carousel-caption" id="imgOverlay">
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
            <div class="login">
                <div class="login-text">Login with your Microsoft Work Account!<br>
                    Click the Microsoft button below
                </div>
                <br>
                <div>
                    <a href="<?php echo Config::instance()->getLoginUrl(); ?>"><input
                            class="loginBtn" type="image" name="login-image" src="../img/log-in_page/microsoft_logo.png"></a>
                </div>
                <br>
                <a class="link" id="regLink" href="registration.php">Have not registered yet? Click Here!</a>
            </div>
            <div id="loginErrorModal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Login Failed</h4>
                        </div>
                        <div class="modal-body">
                            <p>An error occurred while logging in. Please try again.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $('body').on('hidden.bs.modal', '.modal', function () {
                    window.location.href = window.location.href.replace(/(error=1)/, '');
                });

                if (window.location.href.indexOf('error') != -1) {
                    $('#loginErrorModal').modal('show');
                }
            </script>
        </div>
    </body>
</html>
