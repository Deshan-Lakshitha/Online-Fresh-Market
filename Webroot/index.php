<?php
define('WEBROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_NAME"]));
define('ROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

require(ROOT . 'Config/Core.php');

require(ROOT . 'Router.php');
require(ROOT . 'Request.php');
require(ROOT . 'Dispatcher.php');

$dispatch = new Dispatcher();
$dispatch->dispatch();
?>