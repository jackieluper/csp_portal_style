<?php

require_once '_init.php';

$order = new Order('95e724ab-3834-4d4d-a5f9-6bc725a4d87d');

$order->addOrderItem('84A03D81-6B37-4D66-8D4A-FAEA24541538', 'Basic AD for Tech PHP', 1);

$order->submitOrder();
