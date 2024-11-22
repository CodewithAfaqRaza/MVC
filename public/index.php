<?php

use Framework\EnvReader;
use Framework\Http\Request;


define("BASE_PATH", dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';
use Framework\HandleError;

use Framework\Dispatcher;
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

require BASE_PATH . "/config/routes.php";
require BASE_PATH . "/config/services.php";

// $envreader = new EnvReader;
$envreader = $container->get("Framework\EnvReader"::class);
$envreader->reader(BASE_PATH . "/" . ".env");
// dump($_ENV);
if ($_ENV["SHOW_ERRORS"]) {
    ini_set('display_errors', true);
} else {
    ini_set('display_errors', false);

}
set_error_handler("Framework\HandleError::errorHandler");
set_exception_handler("Framework\ExceptionHandler::errorException");
// print $test;

$request = Request::createFromGlobals();
// dd($request);

$dispatcher = new Dispatcher($routes, $container);
$dispatcher->handleUrl($request);





?>