<?php
require "../controllers/config.php";
require "../api/client/_init.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//$subscriptionList[0]->updateFriendlyName();
//$subscriptionList[0]->suspendSubscription();

$customerTenantId = $_SESSION['tid'];
//business logic is in just for demo purpose
$subscription = new Subscription($customerTenantId);
/* @var Subscription[] $subscriptionList */
$subscriptionList = $subscription->getSubscriptionList();


