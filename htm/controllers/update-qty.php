<?php
session_start();
require '../controllers/config.php';
require_once '../api/client/_init.php';


$qty = $_POST['qty'];
$i = $_POST['itemNum'];
$subscriptionList[$i]->updateQuantity();

echo "updated qty: " . $subscriptionList[$i]->getQuantity();