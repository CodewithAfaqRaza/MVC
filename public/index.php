<?php

use App\Database;
use Framework\EnvReader;
use Framework\Http\Request;
use Twig\Environment;


define("BASE_PATH", dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';
use Framework\HandleError;

use Framework\Dispatcher;
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

require BASE_PATH . "/config/routes.php";
require BASE_PATH . "/config/services.php";


$twig = $container->get(Environment::class);
// dd($twig);
$envreader = $container->get("Framework\EnvReader"::class);
$envreader->reader(BASE_PATH . "/" . ".env");

if ($_ENV["SHOW_ERRORS"]) {
    ini_set('display_errors', true);
} else {
    ini_set('display_errors', false);

}
// set_error_handler("Framework\HandleError::errorHandler");
// set_exception_handler("Framework\ExceptionHandler::errorException");


$request = Request::createFromGlobals();


$dispatcher = new Dispatcher($routes, $container);
$response = $dispatcher->handleUrl($request);
$response->send();





?>