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

$sf_company_name = $conn->real_escape_string($company_name);
$sf_user_name = $conn->real_escape_string($user_name);
$sf_aud = $conn->real_escape_string($aud);
$sf_oid = $conn->real_escape_string($oid);
$sf_tid = $conn->real_escape_string($tid);
$sf_company_domain = $conn->real_escape_string($company_domain);

$user = new user();
//$username = $_POST['userId'];
$user->setUsername($user_name);

$compIdStmt = "SELECT id from customer where customer_name='$sf_company_name'";
$compIdRes = $conn->query($compIdStmt);
if ($compIdRes->num_rows > 0) {
    while ($row = $compIdRes->fetch_assoc()) {
        $custId = $row['id'];
        $user->setCustId($custId);
        $_SESSION['custId'] = $custId;
    }
} else {
    echo "Error: " . $compIdStmt . "<br>" . $conn->error;
}
$userExistsStmt = "SELECT username from user where username='$sf_user_name'";
$userExistsRes = $conn->query($userExistsStmt);
if ($userExistsRes->num_rows > 0) {
    while ($row = $userExistsRes->fetch_assoc()) {
        $user_name = $row['username'];
    }
} else {
    $sqlAddCompany = "INSERT INTO customer(customer_name, entity_type, company_tid, is_provised, primary_domain, relationship, discount, active)
            VALUES('$sf_company_name', 'Corporate', '$sf_tid', '0', '$sf_company_domain', 'Cloud Reseller', '0', '1')";
    if ($conn->query($sqlAddCompany) == True) {
        $compInfoStmt = "SELECT id, entity_type from customer where customer_name='$sf_company_name'";
        $compInfoRes = $conn->query($compInfoStmt);
        while ($row = $compInfoRes->fetch_assoc()) {
            $company_id = $row['id'];
            $entity = $row['entity_type'];
            $user->setEntity($entity);
        }
        $sqlAddExistingUser = "INSERT INTO user(username, customer_id, aud, oid, role, tid)
            VALUES('$sf_user_name', '$company_id', '$sf_aud', '$sf_oid', '10', '$sf_tid' )";
        if ($conn->query($sqlAddExistingUser) == TRUE) {
            
        } else {
            echo "Error: " . $sqlAddExistingUser . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sqlAddCompany . "<br>" . $conn->error;
    }
}

$sqlRole = "select role from user where username='$sf_user_name'";
$resRole = $conn->query($sqlRole);
if ($resRole->num_rows > 0) {
    while ($row = $resRole->fetch_assoc()) {
        $role = $row['role'];
        $user->setRole($role);
    }
} else {
    echo "Error: " . $sqlRole . "<br>" . $conn->error;
}
$resEntity = $conn->query("select entity_type from customer where customer_name='$sf_company_name'");
if (mysqli_num_rows($resEntity)) {
    while ($row = mysqli_fetch_assoc($resEntity)) {
        $entity = $row['entity_type'];
        $user->setEntity($entity);
    }
}

$_SESSION['entity'] = $user->entity;
$_SESSION['user'] = $user->username;
$_SESSION['role'] = $user->role;

if (isset($_SESSION['entity']) && isset($_SESSION['role'])) {
    header('refresh:0; url=../portal/products.php');
} else {
    echo "There is an issue with your account please contact your System Administrator!";
}
?>