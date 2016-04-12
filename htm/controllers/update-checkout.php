<?php
session_start();
require 'config.php';

$id = $_POST['id'];
$qty = $_POST['qty'];

echo 'id: ' . $id . '<br>';
echo 'qty: '. $qty . '<br>';

/*
$sql4 = "UPDATE cart SET qty='" . $qty . "' where items='" . $offerID . "'";
        if ($conn->query($sql4) === TRUE) {
            header('Location: ../portal/products.php');
        } else {
            echo "Error updating record: " . $conn->error;
        }

