<?php
require_once '../portal/manageSubscription.php';

$qty = $_POST['qty'];
$i = $_POST['itemNum'];

$subscriptionList[$i]->updateQuantity($qty);

header("Location: ../portal/manageSubscription.php");