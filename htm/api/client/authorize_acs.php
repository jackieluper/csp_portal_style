<?php

ini_set('display_errors','On');
error_reporting(E_STRICT | E_ALL ^ E_DEPRECATED);

function base64DecodeUrlSafe($b64) {
	return base64_decode(str_replace(array('-', '_'), array('+', '/'), $b64));
}

$privateKey = 'hWFZPHCWgZSXCZapw/lv04l+8GIekVbks6WT7EeCmgc=';

if (!isset($_POST['wa']) || empty($_POST['wa'])) {
	header("Location: htm/portal/login.php?error=1");
	exit;
}

if (!isset($_POST['wresult']) || empty($_POST['wresult'])) {
	header("Location: htm/portal/login.php?error=1");
	exit;
}

$xmlParser = xml_parser_create();
xml_parse_into_struct($xmlParser, $_POST['wresult'], $xmlValues, $xmlIndex);
xml_parser_free($xmlParser);

$binSecToken = '';
foreach ($xmlValues as $xmlData) {
	if ($xmlData['tag'] === 'WSSE:BINARYSECURITYTOKEN') {
		$binSecToken = $xmlData['value'];
		break;
	}
}

if (null === ($jwt = base64DecodeUrlSafe($binSecToken))) {
	throw new UnexpectedValueException('Invalid encoding for JWT token');
}

$jwtSegments = explode('.', $jwt);

if (count($jwtSegments) != 3) {
	throw new \RuntimeException('Invalid number of JWT segments');
}

list($headb64, $payloadb64, $cryptob64) = $jwtSegments;

if (null === ($header = json_decode(base64DecodeUrlSafe($headb64)))) {
	throw new UnexpectedValueException('Invalid encoding for JWT segment');
}

if (null === $payload = json_decode(base64DecodeUrlSafe($payloadb64))) {
	throw new UnexpectedValueException('Invalid encoding for JWT segment');
}

$sig = base64DecodeUrlSafe($cryptob64);

if (isset($key)) {
	if (empty($header->alg)) {
		throw new DomainException('Empty JWT algorithm provided');
	}

	if (!function_exists('openssl_verify')) {
		throw new \RuntimeException('Cannot verify JWT signature, OpenSSL not enabled');
	}

	if (!openssl_verify($sig, "$headb64.$payloadb64", $privateKey, OPENSSL_ALGO_SHA256)) {
		throw new UnexpectedValueException('Signature verification for JWT failed');
	}
}

// TODO header data in $header, data is in $payload
var_dump($payload);

// TODO finish existing customer login code
