<?php
require_once './vendor/autoload.php';
use App\Database;
use Framework\Container;
use Framework\Router;
use Framework\Dispatcher;
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

require "config/routes.php";
require "config/services.php";
// $routes->addToRoutes("/regax", ["controller" => "regax", "action" => "test"]);
// $routes->addToRoutes("/waseem/afaq/raza/wase", ["controller" => "waseem", "action" => "Programmer"]);
// $routes->addToRoutes("/showAll", ["controller" => "Articlecontroller", "action" => "showAll"]);
// $routes->addToRoutes("/Uzee", ["controller" => "Articlecontroller", "action" => "uzee"]);
// $routes->addToRoutes("/history", ["controller" => "drupak", "action" => "history"]);
// $routes->addToRoutes("/sports/cricket", ["controller" => "sports", "action" => "cricket"]);


$dispatcher = new Dispatcher($routes, $conatiner);
$dispatcher->handleUrl($url);





?>