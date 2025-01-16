<?php

use App\Database;
use App\Listeners\HeaderResponseEventList;
use App\Listeners\InvalidResponseList;
use App\Listeners\InvaliedResponseList;
use App\Listeners\StudentAddListners;
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
use Framework\Events\StudentAdd;
use Framework\Kernel;

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

require BASE_PATH . "/config/routes.php";
require BASE_PATH . "/config/services.php";
require BASE_PATH . "/config/middlewares.php";


$twig = $container->get(Environment::class);
// dump($container->getConfig()->getSettingsArray());

// $envReader = $container->get("Framework\EnvReader"::class);
// $envReader->reader(BASE_PATH . "/" . ".env");

if ($_ENV["SHOW_ERRORS"]) {
    ini_set('display_errors', true);
} else {
    ini_set('display_errors', false);
    
}
set_error_handler("Framework\HandleError::errorHandler");
set_exception_handler("Framework\ExceptionHandler::errorException");


$request = Request::createFromGlobals();
$container->get(EventDispatcher::class);
require BASE_PATH . "/bootstrap/bootstrap.php";
// dump($container->initialized);
$kernel = $container->get(Kernel::class);
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);





?>