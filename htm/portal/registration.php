<!--
Author: Jason B. Smith
Date: 2/09/16
Managed Solution
-->
<?php
require '../controllers/config.php';
?>
<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="180;url=http://www.msolcsptest.com/htm/controllers/logout.php" >
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link href="../../css/styles.css" type="text/css" rel="stylesheet"/>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type= "text/javascript" src = "../../js/countries_dropdown.js"></script>
    <script src="../../js/loading.js"></script>
    <script type= "text/javascript" src = "../../js/main.js"></script>    
</head>
<div class="header-white"></div>
<div class="ss-stand-alone">
    <div class="ss-nav">
        <div id="header-wrapper">
            <a class="logohover" href="<?php echo $companyLogo ?>">
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
        <h1 class="content-title" id="contentTxt">Registration</h1>
    </div>
</div>
<div class="container">
    <div class="page-header">
        <h2>ACCOUNT INFORMATION <br><small>You will need to <strong>AUTHORIZE <?php echo $ownerName ?></strong> to be your cloud service provider.</small></h2>
    </div>
    <form class="regForm" id="formRegistration" action="../api/add-cust.php" method="post">
        <table class="regTop">
            <tr>
                <th class="regTbl">Company Name *</th>
                <th class="regTbl">Type of Business *</th>
                <th class="regTbl">Primary Domain Name 1 *</th>
            </tr>
            <tr>
                <td class="row1"><input class="form-control" type="text" id='companyName' name="companyName" placeholder="required" required autofocus></td>
                <td class="row1"><select class="form-control" id='businessType' name="businessType" required >
                        <option>Corporate</option>
                        <option>Government</option>
                    </select></td>
                <td class="row1"><input class="form-control" type="text" id='domainName' name="domainName" placeholder="required" required></td>
                <td class="row1" colspan="2"><label class="micExt">.onmicrosoft.com</label></td>
            </tr>
            <tr>
                <th class="regTbl">Address Line 1 *</th>
                <th class="regTbl">Address Line 2 *</th>
                <th class="regTbl"> City *</th>
            </tr>
            <tr>
                <td class="row2"><input class="form-control" type="text" id='address1' name="address1" placeholder="required" required></td>
                <td class="row2"><input class="form-control" type="text" id='address2' name="address2" placeholder="required" ></td>
                <td class="row2"><input class="form-control" type="text" id='city' name="city" required></td>
            </tr>
            <tr>
                <th class="regTbl">Select Country *</th>
                <th class="regTbl">Select State *</th>
                <th class="regTbl">Zip Code *</th>
                <th class="regTbl"></th>
            </tr>
            <tr >
                <td class="row3"><select class="countrySelect" onchange="print_state('state', this.selectedIndex);" id="country" name ="country" required></select>
                    <script language="javascript">print_country("country");</script></td>
                <td class="row3"><select class="countrySelect" name="state" id="state" onchange="(getState())" required></select></td>
                <td class="row3" ><input class="form-control" type="text" name="zip" id="zip" placeholder="required" onkeyup="validateZip(this)" required></td>
                <td class="row3">
                </td>

            </tr>

        </table>
        <div class="page-header">
            <h2>PRIMARY CONTACT</h2> 
        </div>
        <table class="regBottom">
            <tr>
                <th class="regTbl2">First Name *</th>
                <th class="regTbl2">Last Name *</th>
                <th class="regTbl2">Accept Delegation *</th>
            </tr>
            <tr>
                <td class="row4"><input class="form-control" type="text" id='fname' name="fname" placeholder="required" required></td>
                <td class="row4"><input class="form-control" type="text" id='lname' name="lname" placeholder="required" required></td>
                <td class="row4"><div class="checkbox">
                        <label><input type="checkbox" id="cb-delegation" name="delegation" value="accepted" data-toggle="modal" data-target="#myModal" required>Authorize <?php echo $ownerName ?> to be your Cloud Service Provider!</label>
                    </div></td>
            </tr>
            <tr>
                <th class="regTbl2">Email Address *</th>
                <th class="regTbl2">Phone Number </th>
            </tr>
            <tr>
                <td class="row5"><input class="form-control" type="email" name="email" placeholder="required" required></td>
                <td class="row5"><input class="form-control" type="text" name="phoneNum" placeholder="required" ></td>
            </tr>
        </table>
    </form >    
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="getElementById('cb-delegation').checked = false">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p>You are <strong>Authorizing <?php echo $ownerName ?></strong> to be your Cloud Service Provider.<br><br>
                        By continuing, you agree that Microsoft can share your ongoing contact and subscription information with this partner. For more information, please review the
                        <strong><a class="microsoftLink" target="new" href="http://g.microsoftonline.com/0BX20en/328">Privacy Notice</a></strong><br><br>

                        Click for <strong><a class="microsoftLink" target="new" href="https://portal.office.com/CompanyManagement/PublicCompanyProfile.aspx?id=271cf5e9-b477-4759-a5d6-6d459bb35f3e&msppid=0">Partner Information</a></strong> </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="getElementById('cb-delegation').checked = true">Accept</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" value="decline" onclick="getElementById('cb-delegation').checked = false">Decline</button>
                </div>
            </div>

        </div>
    </div>
    <button class="regBtn" type="submit" name="submit" form="formRegistration" value="Submit">Submit</button>
    <button class="resetBtn" type="reset" form="formRegistration" value="Reset">Reset</button>
</div>

