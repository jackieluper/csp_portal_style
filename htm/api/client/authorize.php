<?php

require_once '_init.php';

$adAuth = new AdAuth();

$authCode = $_GET['code'];

$adAuth->requestAdTokenForAuthCode($authCode);

var_dump($adAuth->getAdToken());
