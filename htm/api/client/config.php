<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php

//top offers figured by entity type

//Sets admin role so it is not visible;
$adminRole = 30;
//Sets user role for comparison
$userRole = 10;
//Company specific info for config
//client id is our app id TODO: NEEDS TO BE CHANGED TO OUR APP ID ON CSP API WHEN WE GO LIVE
$clientID = "c9d95c0e-8d97-4bba-b3a1-05bad83f7300";
//TODO CLIENT SECRET KEY NEEDS TO BE CHANGED AS WELL WHEN WE GO LIVE
//Client Secret key of the application.
$clientSecret = "RqK2qX3TEFfTMrluU3BRQh0lKhgsvbaVqbyZvmax/3g=";
//Company url
$companyUrl = "managedsolutioncsptesting.onmicrosoft.com";
//OAuth Url.
$authUrl = "https://login.microsoftonline.com/managedsolutioncsptesting.onmicrosoft.com";
//Application Scope Url
$resource = "https://graph.windows.net";
//Set company name 
$companyName = "Managed Solution";
//Setting logo for company
$companyLogo = "http://www.managedsolution.com";
//Setting up homepage for vertical menu
$homePage = "http://www.managedsolution.com";
//DB configs
//where your hosting
$servername = "127.0.0.1";
//Your username for DB
$username = "root";
//Your pass for DB
$password = "Ltd6530*%";
//DB name that you are using
$dbname = "discount_estimates";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

