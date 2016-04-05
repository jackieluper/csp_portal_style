<?php
session_start();
require '../controllers/config.php';
require_once '../api/client/_init.php';

echo $_POST['qty'] . '<br>';
echo $_POST['name'];

