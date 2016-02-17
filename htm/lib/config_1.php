<?php
$DB_TYPE = 'mysql'; //Type of database<br>
$DB_HOST = 'localhost'; //Host name<br>
$DB_USER = 'root'; //Host Username<br>
$DB_PASS = 'Lgv98011*%'; //Host Password<br>
$DB_NAME = 'discount_estimates'; //Database name<br><br>

$dbh = new PDO("$DB_TYPE:host=$DB_HOST; dbname=$DB_NAME;", $DB_USER, $DB_PASS);

?>
