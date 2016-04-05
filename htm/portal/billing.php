<!--
Author: Jason B. Smith
Date: 2/29/16
Managed Solution
-->
<?php
session_start();
require("../controllers/config.php");
require '../controllers/cart.db.php';
require '../api/client/app/order.class.php';

$tid = $_SESSION['tid'];


// API Setup parameters
$gatewayURL = 'https://secure.gateway-paymentechnology.com/api/v2/three-step';
$APIKey = 'CkdE324pr5pYCn5B6aMyVpW2z7qtBK6M';

//Getting transaction ID to add to reciept for customer reference
$sqlTran = "SELECT transaction_id FROM cart WHERE customer_id='" . $_SESSION['custId'] . "'";
$resultTran = $conn->query($sqlTran);
if ($resultTran->num_rows > 0) {
    while ($row = $resultTran->fetch_assoc()) {
        $tranId = $row['transaction_id'];
    }
} else {
    echo "Failed to save transaction";
}

// If there is no POST data or a token-id, print the initial shopping cart form to get ready for Step One.
if (empty($_POST['DO_STEP_1']) && empty($_GET['token-id'])) {

    print '  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
    print '
    <html>
      <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
         <title>Products</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>      
        <link href="../../css/styles.css" type="text/css" rel="stylesheet"/>
        <script src="../../js/ms-style-menu.js"></script>
        <script src="../../js/ms-style-cart.js"></script>
        <script src="../../js/cc-validation.js"></script>
        <script src="../../js/main.js"></script>        
        <title>Billing Information</title>
      </head>
      <body>
      <div id="horizontalNav">
    <div id="horizontalNavWrapper">
        <ul>
            <li>Products</li>
        </ul>
    </div>
</div>
<nav class="menu">
    <a href="#" class="nav-toggle-btn">Menu</a>
    <ul>
        <li><img class="icon" src="../img/icons/software.png" alt="Software" ><a href="products.php">Products</a><br></li>
        <li><img class="icon" src="../img/icons/invoice.jpg" alt="Invoice"><a href="invoice.php">Invoice</a><br></li>
        <li><img class="icon" src="../img/icons/checkout.png" alt="Software" ><a href="checkout.php">Checkout</a><br></li>
        <li><img class="icon" src="../img/icons/home.png" alt="Software" ><a href="http://www.managedsolution.com">Managed Solution</a><br></li>
        <li><img class="icon" src="../img/icons/contact.jpg" alt="Contact" ><a href="contactUs.php">Contact us</a><br></li>
        <li><img class="icon" src="../img/icons/logout.png" alt="Software" ><a href="../controllers/logout.php">Logout</a><br></li>
    </ul>
</nav>
<div class="billContent">
      <p ><h2>Please fill out your billing information.<br /></h2></p>

      <h3> Customer Information</h3>
      <h4> Billing Details</h4>

        <form action="" method="post">
          <table>
          <tr><td>Company *</td><td><input type="text"  name="billing-address-company" value="" placeholder="required" required></td></tr>
          <tr><td>First Name *</td><td><input type="text" id="billing-address-first-name" name="billing-address-first-name" placeholder="required" value="" onkeyup="validateFname()" required></td></tr>
          <tr><td>Last Name *</td><td><input type="text" id="billing-address-last-name" name="billing-address-last-name" placeholder="required" value="" onkeyup="validateLname()" required></td></tr>
          <tr><td>Address *</td><td><input type="text" name="billing-address-address1" placeholder="required" value="" required></td></tr>
          <tr><td>Address 2 </td><td><input type="text" name="billing-address-address2" value=""></td></tr>
          <tr><td>City *</td><td><input type="text" name="billing-address-city" placeholder="required" value="" required></td></tr>
          <tr><td>State/Province *</td><td><input type="text" name="billing-address-state" placeholder="required" value="" required></td></tr>
          <tr><td>Zip/Postal *</td><td><input type="text" name="billing-address-zip" placeholder="required" value="" required></td></tr>
          <tr><td>Country *</td><td><input type="text" name="billing-address-country" placeholder="required" value="US" required></td></tr>
          <tr><td>Phone Number *</td><td><input type="text" id="billing-address-phone" name="billing-address-phone" placeholder="required" value="" onkeyup="validatePhone()" required></td></tr>
          <tr><td>Email Address *</td><td><input type="text" id="billing-address-email" name="billing-address-email" placeholder="required" value="" onkeyup="validateEmail()" required></td></tr>
          
          <tr><td colspan="2" align=center><input class="ccBtn" type="submit" value="Submit Step One"><input type="hidden" name ="DO_STEP_1" value="true"></td></tr>
          </table>

        </form>
      </body>
    </html>
</div>
    ';
} else if (!empty($_POST['DO_STEP_1'])) {

    // Initiate Step One: Now that we've collected the non-sensitive payment information, we can combine other order information and build the XML format.
    $xmlRequest = new DOMDocument('1.0', 'UTF-8');

    $xmlRequest->formatOutput = true;
    $xmlSale = $xmlRequest->createElement('sale');

    // Amount, authentication, and Redirect-URL are typically the bare minimum.
    appendXmlNode($xmlRequest, $xmlSale, 'api-key', $APIKey);
    appendXmlNode($xmlRequest, $xmlSale, 'redirect-url', $_SERVER['HTTP_REFERER']);
    appendXmlNode($xmlRequest, $xmlSale, 'amount', number_format($cart->total, 2));
    appendXmlNode($xmlRequest, $xmlSale, 'ip-address', $_SERVER["REMOTE_ADDR"]);
    //appendXmlNode($xmlRequest, $xmlSale, 'processor-id' , 'processor-a');
    appendXmlNode($xmlRequest, $xmlSale, 'currency', 'USD');

    // Some additonal fields may have been previously decided by user
    appendXmlNode($xmlRequest, $xmlSale, 'order-id', $tranId);
    appendXmlNode($xmlRequest, $xmlSale, 'order-description', 'Order');
    appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-1', 'Red');
    appendXmlNode($xmlRequest, $xmlSale, 'merchant-defined-field-2', 'Medium');
    appendXmlNode($xmlRequest, $xmlSale, 'tax-amount', 'NONE');

    /* if(!empty($_POST['customer-vault-id'])) {
      appendXmlNode($xmlRequest, $xmlSale, 'customer-vault-id' , $_POST['customer-vault-id']);
      }else {
      $xmlAdd = $xmlRequest->createElement('add-customer');
      appendXmlNode($xmlRequest, $xmlAdd, 'customer-vault-id' ,411);
      $xmlSale->appendChild($xmlAdd);
      } */


    // Set the Billing from what was collected on initial shopping cart form
    $xmlBillingAddress = $xmlRequest->createElement('billing');
    appendXmlNode($xmlRequest, $xmlBillingAddress, 'first-name', $_POST['billing-address-first-name']);
    appendXmlNode($xmlRequest, $xmlBillingAddress, 'last-name', $_POST['billing-address-last-name']);
    appendXmlNode($xmlRequest, $xmlBillingAddress, 'address1', $_POST['billing-address-address1']);
    appendXmlNode($xmlRequest, $xmlBillingAddress, 'city', $_POST['billing-address-city']);
    appendXmlNode($xmlRequest, $xmlBillingAddress, 'state', $_POST['billing-address-state']);
    appendXmlNode($xmlRequest, $xmlBillingAddress, 'postal', $_POST['billing-address-zip']);
    //billing-address-email
    appendXmlNode($xmlRequest, $xmlBillingAddress, 'country', $_POST['billing-address-country']);
    appendXmlNode($xmlRequest, $xmlBillingAddress, 'email', $_POST['billing-address-email']);
    appendXmlNode($xmlRequest, $xmlBillingAddress, 'phone', $_POST['billing-address-phone']);
    appendXmlNode($xmlRequest, $xmlBillingAddress, 'company', $_POST['billing-address-company']);
    appendXmlNode($xmlRequest, $xmlBillingAddress, 'address2', $_POST['billing-address-address2']);
    $xmlSale->appendChild($xmlBillingAddress);

    //Get cart items and add to reciept
    $sql = "SELECT item_name, sku, msrp, qty from cart where customer_id='" . $_SESSION['custId'] . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Products already chosen by user
            $xmlProduct = $xmlRequest->createElement('product');
            appendXmlNode($xmlRequest, $xmlProduct, 'product-code', $row['sku']);
            appendXmlNode($xmlRequest, $xmlProduct, 'description', $row['item_name']);
            appendXmlNode($xmlRequest, $xmlProduct, 'commodity-code', 'N/A');
            appendXmlNode($xmlRequest, $xmlProduct, 'unit-of-measure', '1 MONTH');
            appendXmlNode($xmlRequest, $xmlProduct, 'unit-cost', $row['msrp']);
            appendXmlNode($xmlRequest, $xmlProduct, 'quantity', number_format($row['qty'], 2));
            appendXmlNode($xmlRequest, $xmlProduct, 'total-amount', number_format($cart->total, 2));
            appendXmlNode($xmlRequest, $xmlProduct, 'tax-amount', 'N/A');

            appendXmlNode($xmlRequest, $xmlProduct, 'tax-rate', 'NONE');
            appendXmlNode($xmlRequest, $xmlProduct, 'discount-amount', number_format($cart->discount, 2));
            appendXmlNode($xmlRequest, $xmlProduct, 'discount-rate', number_format($cart->discountRate, 2));
            appendXmlNode($xmlRequest, $xmlProduct, 'tax-type', 'NONE');
            appendXmlNode($xmlRequest, $xmlProduct, 'alternate-tax-id', 'N/A');

            $xmlSale->appendChild($xmlProduct);
        }
    }

    $xmlRequest->appendChild($xmlSale);

    // Process Step One: Submit all transaction details to the Payment Gateway except the customer's sensitive payment information.
    // The Payment Gateway will return a variable form-url.
    $data = sendXMLviaCurl($xmlRequest, $gatewayURL);

    // Parse Step One's XML response
    $gwResponse = @new SimpleXMLElement($data);
    if ((string) $gwResponse->result == 1) {
        // The form url for used in Step Two below
        $formURL = $gwResponse->{'form-url'};
    } else {
        throw New Exception(print " Error, received " . $data);
    }

    // Initiate Step Two: Create an HTML form that collects the customer's sensitive payment information
    // and use the form-url that the Payment Gateway returns as the submit action in that form.
    print '  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';


    print '

        <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
            <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>      
            <link href="../../css/styles.css" type="text/css" rel="stylesheet"/>
            <script src="../../js/ms-style-menu.js"></script>
            <script src="../../js/ms-style-cart.js"></script>
            <script src="../../js/main.js"></script>
            <title>Billing Info</title>
        </head>
        <body>';
    // Uncomment the line below if you would like to print Step One's response
    // print '<pre>' . (htmlentities($data)) . '</pre>';
    print '
        <div id="horizontalNav">
         <div id="horizontalNavWrapper">
             <ul>
                 <li>Products</li>
             </ul>
         </div>
     </div>
     <nav class="menu">
         <a href="#" class="nav-toggle-btn">Menu</a>
         <ul>
            <li><img class="icon" src="../img/icons/software.png" alt="Software" ><a href="products.php">Products</a><br></li>
            <li><img class="icon" src="../img/icons/invoice.jpg" alt="Invoice"><a href="invoice.php">Invoice</a><br></li>
            <li><img class="icon" src="../img/icons/checkout.png" alt="Software" ><a href="checkout.php">Checkout</a><br></li>
            <li><img class="icon" src="../img/icons/home.png" alt="Software" ><a href="http://www.managedsolution.com">Managed Solution</a><br></li>
            <li><img class="icon" src="../img/icons/contact.jpg" alt="Contact" ><a href="contactUs.php">Contact us</a><br></li>
            <li><img class="icon" src="../img/icons/logout.png" alt="Software" ><a href="../controllers/logout.php">Logout</a><br></li>
        </ul>
     </nav>
     <div class="billContent">
             <p><h2>Please fill out your Credit Card Information.<br /></h2></p>

             <form action="' . $formURL . '" method="POST">
             <h3> Payment Information</h3>
                 <table>
                     <tr><td>Credit Card Number</td><td><input type ="text" id="billing-cc-number" name="billing-cc-number" value="4111111111111111" onkeyup="validateCardNumber()" placeholder="required" required> </td></tr>
                     <tr><td>Expiration Date</td><td><input type ="text" id="billing-cc-exp" name="billing-cc-exp" value="1012" placeholder="required" onkeyup="validateCardDate()" required> </td></tr>
                     <tr><td>CVV</td><td><INPUT type ="text" name="cvv" placeholder="required" required> </td></tr>
                     <tr><td colspan="2" align=center><input  class="ccBtn" type ="submit" value="Submit Step Two"></td> </tr>
                 </table>
             </form>
             </body>
             </html>
     </div> ';
} elseif (!empty($_GET['token-id'])) {

    // Step Three: Once the browser has been redirected, we can obtain the token-id and complete
    // the transaction through another XML HTTPS POST including the token-id which abstracts the
    // sensitive payment information that was previously collected by the Payment Gateway.
    $tokenId = $_GET['token-id'];
    $xmlRequest = new DOMDocument('1.0', 'UTF-8');
    $xmlRequest->formatOutput = true;
    $xmlCompleteTransaction = $xmlRequest->createElement('complete-action');
    appendXmlNode($xmlRequest, $xmlCompleteTransaction, 'api-key', $APIKey);
    appendXmlNode($xmlRequest, $xmlCompleteTransaction, 'token-id', $tokenId);
    $xmlRequest->appendChild($xmlCompleteTransaction);


    // Process Step Three
    $data = sendXMLviaCurl($xmlRequest, $gatewayURL);


    $gwResponse = @new SimpleXMLElement((string) $data);
    print '  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
    print '
    <html>
      <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
            <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>      
            <link href="../../css/styles.css" type="text/css" rel="stylesheet"/>
            <script src="../../js/ms-style-menu.js"></script>
            <script src="../../js/ms-style-cart.js"></script>
            <script src="../../js/main.js"></script>
        <title>Transaction Complete</title>
      </head>
      <body>';

    print '
        <div id="horizontalNav">
         <div id="horizontalNavWrapper">
             <ul>
                 <li>Products</li>
             </ul>
         </div>
     </div>
     <nav class="menu">
         <a href="#" class="nav-toggle-btn">Menu</a>
         <ul>
            <li><img class="icon" src="../img/icons/software.png" alt="Software" ><a href="products.php">Products</a><br></li>
            <li><img class="icon" src="../img/icons/invoice.jpg" alt="Invoice"><a href="invoice.php">Invoice</a><br></li>
            <li><img class="icon" src="../img/icons/checkout.png" alt="Software" ><a href="checkout.php">Checkout</a><br></li>
            <li><img class="icon" src="../img/icons/home.png" alt="Software" ><a href="http://www.managedsolution.com">Managed Solution</a><br></li>
            <li><img class="icon" src="../img/icons/contact.jpg" alt="Contact" ><a href="contactUs.php">Contact us</a><br></li>
            <li><img class="icon" src="../img/icons/logout.png" alt="Software" ><a href="../controllers/logout.php">Logout</a><br></li>
        </ul>
     </nav>
     <div class="transactionContent">
        <p><h2>Transaction Details<br /></h2></p>';

    if ((string) $gwResponse->result == 1) {
        //need to parse customer TID from login
        $order = new Order($tid);
        print '<div id="print-content">
                <form>';
        ?>
        <div><img class='invoiceLogo' src="../img/MS_Logo_orange_small.png" alt=<?php echo $companyName ?>></div>
        <?php
        print " <p><h3><strong>Transaction was Approved: </strong></h3></p>\n";
        $xml = simplexml_load_string($data);
        $amount = $xml->amount;
        $company = $xml->{'processor-id'};
        $orderId = $xml->{'order-id'};
        print '            
        <div><strong>Order ID: ' . $orderId . '</strong></div><br>';
        foreach ($xml->product as $product) {
            $lineItem = 0;
            $qty = (int) $product->quantity;
            $qtyFormatted = intval($qty);
            $cost = (float) $product->{'unit-cost'};
            $costFormatted = number_format($cost, 2);
            $itemNum = $product->{'unit-of-measure'};
            $sku = $product->{'product-code'};
            $name = $product->description;
            $discountRate = $product->{'discount-rate'};
            $totalSavings = $product->{'discount-amount'};
            
            
            
            $sqlInvoice = "INSERT INTO transactions(customer_id, item_num, sku, product_name, subscription_length, product_cost, qty, discount_rate, total_savings, total, transaction_id)
            VALUES(" . $_SESSION['custId'] . ", '$itemNum', '$sku', '$name', '1 month(s)', '$cost', '$qtyFormatted', '$discountRate', '$totalSavings', '$amount', $tranId)";
            $resultInvoice = $conn->query($sqlInvoice);

            print '
        <div><strong>Item Number: ' . $itemNum . '</strong></div>
        <div>--------------</div>
        <div><strong>Product Name: </strong>' . $name . '</div>
        <div><strong>Subscription ID: </strong>' . $sku . '</div>
        <div><strong>Subscription Length: </strong>1 Month(s) </div>
        <div><strong>Product Cost: </strong>$' . $costFormatted . '</div>
        <div><strong>Product Quantity: </strong>' . $qtyFormatted . '</div><br>';
        }
        //$order->addOrderItem("3c95518e-8c37-41e3-9627-0ca339200f53/offers/84A03D81-6B37-4D66-8D4A-FAEA24541538", "friendlyName", $qtyFormatted, '22e38d40-62cb-47c4-afdf-19421c5522c0');
        $order->submitOrder();
        print '
        <div><strong>Discount Rate: ' . $discountRate . '%</strong></div>
        <div><strong>Total Savings: $' . $totalSavings . '</strong></div>
        <div><strong>Sale Total: ' . $amount . '</strong></div><br>
        </form>
        </div>';
        $sqlDelete = "DELETE FROM cart where customer_id='" . $_SESSION['custId'] . "'";
        $resultDelete = $conn->query($sqlDelete);
    }
    ?>
    <input type="button" class="receiptBtn" onclick="printDiv('print-content')" value="Print Receipt"/>
    </div>
    <script type="text/javascript">

        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>

    <?php
} elseif ((string) $gwResponse->result == 2) {
    print " <p><h3><strong> Transaction was Declined.</strong></h3>\n";
    print " Decline Description : " . (string) $gwResponse->{'result-text'} . " </p>";
    print " <p><h3>XML response was:</h3></p>\n";
    print '<pre>' . (htmlentities($data)) . '</pre>';
} else {
    print " <p><h3><strong> Transaction caused an Error.</strong></h3>\n";
    print " Error Description: " . (string) $gwResponse->{'result-text'} . " </p>";
    print " <p><h3>XML response was:</h3></p>\n";
    print '<pre>' . (htmlentities($data)) . '</pre>';
}
print "</body></html>";

function sendXMLviaCurl($xmlRequest, $gatewayURL) {
    // helper function demonstrating how to send the xml with curl
    $ch = curl_init(); // Initialize curl handle
    curl_setopt($ch, CURLOPT_URL, $gatewayURL); // Set POST URL

    $headers = array();
    $headers[] = "Content-type: text/xml";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Add http headers to let it know we're sending XML
    $xmlString = $xmlRequest->saveXML();
    curl_setopt($ch, CURLOPT_FAILONERROR, 1); // Fail on errors
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // Allow redirects
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Return into a variable
    curl_setopt($ch, CURLOPT_PORT, 443); // Set the port number
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Times out after 30s
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlString); // Add XML directly in POST
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    // This should be unset in production use. With it on, it forces the ssl cert to be valid
    // before sending info.
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    if (!($data = curl_exec($ch))) {
        print "curl error =>" . curl_error($ch) . "\n";
        throw New Exception(" CURL ERROR :" . curl_error($ch));
    }
    curl_close($ch);

    return $data;
}

// Helper function to make building xml dom easier
function appendXmlNode($domDocument, $parentNode, $name, $value) {
    $childNode = $domDocument->createElement($name);
    $childNodeValue = $domDocument->createTextNode($value);
    $childNode->appendChild($childNodeValue);
    $parentNode->appendChild($childNode);
}
