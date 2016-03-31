<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
session_start();
include 'config.php';
include '../classes/user.class.php';

$user = new user();
$user->setUsername($_SESSION['username']);

$resId = $conn->query("select customer_id, role from user where username='" . $user->username . "'");
if (mysqli_num_rows($resId)) {
    while ($row = mysqli_fetch_assoc($resId)) {
        $custId = $row['customer_id'];
        $role = $row['role'];
    }
}
$user->setCustId($custId);
$user->setRole($role);
$_SESSION['role'] = $user->role;
$_SESSION['custId'] = $user->custId;

$resEntity = $conn->query("select entity_type from customer where id='" . $user->custId . "'");
if (mysqli_num_rows($resEntity)) {
    while ($row = mysqli_fetch_assoc($resEntity)) {
        $entity = $row['entity_type'];
    }
}
$user->setEntity($entity);
$_SESSION['entity'] = $user->entity;
$_SESSION['user'] = $user->username;

header('refresh:0; url=../portal/products.php');
?>