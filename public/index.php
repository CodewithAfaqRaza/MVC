<?php

use App\Database;
use App\Listeners\HeaderResponseEventList;
use App\Listeners\InvalidResponseList;
use App\Listeners\InvaliedResponseList;
use Framework\EnvReader;
use Framework\Http\Request;
use Framework\SessionHandler;
use Twig\Environment;


define("BASE_PATH", dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';
use Framework\HandleError;

use Framework\Dispatcher;
use Framework\EventDispatcher\EventDispatcher;
use Framework\Events\ResponseEvent;
use Framework\Kernel;

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

require BASE_PATH . "/config/routes.php";
require BASE_PATH . "/config/services.php";
require BASE_PATH . "/config/middlewares.php";


$twig = $container->get(Environment::class);
// dd($twig);
$envReader = $container->get("Framework\EnvReader"::class);
$envReader->reader(BASE_PATH . "/" . ".env");

if ($_ENV["SHOW_ERRORS"]) {
    ini_set('display_errors', true);
} else {
    ini_set('display_errors', false);

}
$eventDispatcher = $container->get(EventDispatcher::class);
$eventDispatcher->addListeners(ResponseEvent::class, new HeaderResponseEventList)->addListeners(ResponseEvent::class, new InvaliedResponseList);
// set_error_handler("Framework\HandleError::errorHandler");
// set_exception_handler("Framework\ExceptionHandler::errorException");


$request = Request::createFromGlobals();


$dispatcher = new Kernel($routes, $container,$middlewares,$eventDispatcher);
$response = $dispatcher->handle($request);
$response->send();





?>