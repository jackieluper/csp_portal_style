<?php

$g_authDisabled = array(
	'post' => 'noauth',
	'postid' => 'noauth',
	'get' => 'noauth',
	'getid' => 'noauth',
	'put' => 'noauth',
	'putid' => 'noauth',
	'delete' => 'noauth',
	'deleteid' => 'noauth'
);

$g_authEnabled = array(
	'post' => 'auth',
	'postid' => 'auth',
	'get' => 'auth',
	'getid' => 'auth',
	'put' => 'auth',
	'putid' => 'auth',
	'delete' => 'auth',
	'deleteid' => 'auth'
);

function noauth() {
}

function auth() {
	if (!isset($_SESSION['profile']['id']) || empty($_SESSION['profile']['id'])) {
		$app = \Slim\Slim::getInstance();

		$app->halt(401, '{"error": "Access denied. Not authenticated."}');
	}
}
