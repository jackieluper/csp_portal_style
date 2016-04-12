<?php
session_start();
require 'config.php';

$id = $_POST['id'];
$qty = $_POST['qty'];


$sql4 = "UPDATE cart SET qty='" . $qty . "' where items='" . $offerID . "'";
        if ($conn->query($sql4) === TRUE) {
            header('Location: ../portal/checkout.php');
        } else {
            echo "Error updating record: " . $conn->error;
        }

