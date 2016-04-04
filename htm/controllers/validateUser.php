<!--
Author: Jason B. Smith
Date: 2/17/16
Managed Solution
-->
<?php
session_start();
include 'config.php';
include '../classes/user.class.php';

$user_name = $_SESSION['username'];
$company_name = $_SESSION['company_name'];
$aud = $_SESSION['aud'];
$oid = $_SESSION['oid'];
$tid = $_SESSION['tid'];
$company_domain = $_SESSION['company_domain'];

$user = new user();
//$username = $_POST['userId'];
$user->setUsername($_POST['userId']);

$sqlCompanyCheck = "SELECT * from customer where customer_name='" . $_SESSION['company_name'] . "'";
$resCompanyCheck = $conn->query($sqlCompanyCheck);
if ($resCompanyCheck->num_rows > 0) {
    $customer_id = $row['id'];
} else {
    $sqlAddCompany = "INSERT INTO customer set(customer_name, entity_type, company_tid, is_provised, primary_domain, relationship, discount, active)
            VALUES('$company_name', 'Corporate', '$tid', '0', '$company_domain', 'Cloud Reseller', '0', '1')";
    if ($conn->query($sqlAddCompany) == True) {
        $sql = "SELECT id from customer where customer_name='$company_name'";
        $res = $conn->query($sql);
        while ($row = $res->fetch_assoc()) {
            $company_id = $row['id'];
        }
        $sqlAddExistingUser = "INSERT INTO user set(username, customer_id, aud, oid, role, tid)
            VALUES('$user_name', '$company_id', '$aud', '$oid', '10', '$tid' )";
        if ($conn->query($sqlAddExistingUser) == TRUE) {
            $resId = $conn->query("select customer_id, role from user where username='" . $user->username . "'");
            if (mysqli_num_rows($resId)) {
                while ($row = mysqli_fetch_assoc($resId)) {
                    $custId = $row['customer_id'];
                    $role = $row['role'];
                    $user->setCustId($custId);
                    $user->setRole($role);
                    $_SESSION['role'] = $user->role;
                    $_SESSION['custId'] = $user->custId;
                }
            }
        }
    }
}


$resEntity = $conn->query("select entity_type from customer where id='" . $user->custId . "'");
if (mysqli_num_rows($resEntity)) {
    while ($row = mysqli_fetch_assoc($resEntity)) {
        $entity = $row['entity_type'];
    }
}
$user->setEntity($entity);
echo $user->getEntity();
$_SESSION['entity'] = $user->entity;
$_SESSION['user'] = $user->username;

if (isset($_SESSION['entity'])) {
    header('refresh:0; url=../portal/products.php');
} else {
    echo "There is an issue with your account please contact your System Administrator!";
}
?>