<?php

date_default_timezone_set('UTC');
define('CLASS_DIR', '/app/');
set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__) . CLASS_DIR);
spl_autoload_extensions('.class.php');
spl_autoload_register();

Debug::enable();

// Session::start();
