<?php

class StringUtil {
	function __construct() {}

	// TODO maybe i want a guuid
	static function generateRandomString($length = 10) {
		return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
	}

	static function generateGuid() {
		mt_srand((double) microtime() * 10000);
		$charid = strtoupper(md5(uniqid(rand(), true)));
		$hyphen = chr(45); // "-"
		$uuid = substr($charid, 0, 8) . $hyphen
			. substr($charid, 8, 4) . $hyphen
			. substr($charid, 12, 4) . $hyphen
			. substr($charid, 16, 4) . $hyphen
			. substr($charid, 20, 12);
		return $uuid;
	}

	static function stringToBool($rawInput) {
		$cleanInput = strtolower(trim(preg_replace('/[^\P{C}\n]+/u', '', $rawInput)));
		return filter_var($cleanInput, FILTER_VALIDATE_BOOLEAN);
	}
}
