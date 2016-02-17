<?php

define('API_VER', '0');
define('API', '/api/v' . API_VER);
define('CLASS_DIR', '/app/');
ini_set('display_errors','On');
ini_set('memory_limit', '128M');
set_time_limit(3600);
error_reporting(E_STRICT | E_ALL ^ E_DEPRECATED);
header_remove('X-Powered-By');

if (isset($_SERVER['HTTP_ORIGIN'])) {
	header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
	header('Access-Control-Allow-Credentials: true');

	// TODO REMOVE THIS ON PRODUCTION
	header('Access-Control-Max-Age: 1');
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
	}

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
		header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
	}

	exit(0);
}

date_default_timezone_set('UTC');
set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__) . CLASS_DIR);
spl_autoload_extensions('.class.php');
spl_autoload_register();

require_once 'lib/autoload.php';

Config::debug_check();

Session::start();

$app = new \Slim\Slim(array(
	'templates.path' => '.'
));

require_once 'auth.php';
require_once 'http_codes.php';
require_once 'mime_types.php';

$app->notFound(function () use ($app) {
	$app->render('404.htm');
});

$app->run();
