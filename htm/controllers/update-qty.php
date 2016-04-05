<?php
$qty = $_POST['qty'];
$i = $_POST['itemNum'];
$subscriptionList = $subscription->getSubscriptionList();
$subscriptionList[$i]->updateQuantity($qty);

echo "updated qty: " . $subscriptionList[$i]->getQuantity();