<?php

class Session {
	function __construct() {
	}

	static function start() {
		session_start();
	}

	static function isExpired($sessionTimeVar) {
		if ($_SESSION[$sessionTimeVar] > time() + 1) {
			return false;
		}

		return true;
	}

	static function isAdExpired() {
		return self::isExpired('api_expires_on');
	}

	static function isCrestExpired() {
		return self::isExpired('crest_expires_on');
	}

	static function expire() {
		session_destroy();
	}
}
