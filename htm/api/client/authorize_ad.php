<?php

require_once '_init.php';
require 'config.php';
$authCode = $_GET['code'];
$userAuth = new UserAuth();
$userAuth->requestAdTokenForAuthCode($authCode);
var_dump($userAuth->getIdToken());
echo $userAuth->getUniqueName();
die();

//
//
//
//ini_set('display_errors','On');
//error_reporting(E_STRICT | E_ALL ^ E_DEPRECATED);
//
//function base64DecodeUrlSafe($b64) {
//	return base64_decode(str_replace(array('-', '_'), array('+', '/'), $b64));
//}
//
//$privateKey = 'hWFZPHCWgZSXCZapw/lv04l+8GIekVbks6WT7EeCmgc=';
//
//// TODO ... is this POST DATA?
//// TODO confirm 'wa' and 'wresult' exist
//$data['wa'] = 'wsignin1.0';
//$data['wresult'] = '2016-03-22T06:07:23.260Z2016-03-22T07:07:23.260Z
//http://billing.managedsolution.com/