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
$user->setUsername($user_name);

$sqlCompanyCheck = "SELECT id from customer where customer_name='$company_name'";
$resCompanyCheck = $conn->query($sqlCompanyCheck);
if ($resCompanyCheck->num_rows > 0) {
    $customer_id = $row['id'];
    $_SESSION['custId'] = $customer_id;
}
$sqlCompanyCheck = "SELECT username from user where username='$user_name'";
$resCompanyCheck = $conn->query($sqlCompanyCheck);
if ($resCompanyCheck->num_rows > 0) {
    $user_name = $row['username'];
} else {
    $sqlAddCompany = "INSERT INTO customer(customer_name, entity_type, company_tid, is_provised, primary_domain, relationship, discount, active)
            VALUES('$company_name', 'Corporate', '$tid', '0', '$company_domain', 'Cloud Reseller', '0', '1')";
    if ($conn->query($sqlAddCompany) == True) {
        $sql = "SELECT id, entity_type from customer where customer_name='$company_name'";
        $res = $conn->query($sql);
        while ($row = $res->fetch_assoc()) {
            $company_id = $row['id'];
            $entity = $row['entity_type'];
            $user->setEntity($entity);
        }
        $sqlAddExistingUser = "INSERT INTO user(username, customer_id, aud, oid, role, tid)
            VALUES('$user_name', '$company_id', '$aud', '$oid', '10', '$tid' )";
        if ($conn->query($sqlAddExistingUser) == TRUE) {
            
        } else {
            echo "Error: " . $sqlAddExistingUser . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sqlAddCompany . "<br>" . $conn->error;
    }
}

$sqlRole = "select role from user where username='$user_name'";
$resRole = $conn->query($sqlRole);
if ($resRole->num_rows > 0) {
    while ($row = $resRole->fetch_assoc()) {
        $role = $row['role'];
        $user->setRole($role);
    }
} else {
    echo "Error: " . $sqlRole . "<br>" . $conn->error;
}
$resEntity = $conn->query("select entity_type from customer where customer_name='$company_name'");
if (mysqli_num_rows($resEntity)) {
    while ($row = mysqli_fetch_assoc($resEntity)) {
        $entity = $row['entity_type'];
        $user->setEntity($entity);
    }
}

$_SESSION['entity'] = $user->entity;
$_SESSION['user'] = $user->username;
$_SESSION['role'] = $user->role;

echo "entity: " . $user->entity . '<br>';
echo "user: " . $user->username . '<br>';
echo "role: " . $user->role . '<br>';
if (isset($_SESSION['entity']) && isset($_SESSION['role'])) {
    header('refresh:0; url=../portal/products.php');
} else {
    echo "There is an issue with your account please contact your System Administrator!";
}
?>