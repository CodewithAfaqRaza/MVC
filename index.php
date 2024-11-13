<?php
require_once './vendor/autoload.php';
use Framework\Router;
use Framework\Dispatcher;
 $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

 $routes = new Router;
 $routes->addToRoutes('/{controller}/{action}');
 $routes->addToRoutes('/node/{slug:\d+}', ["controller"=>"node", "action"=>"display"]);
 $routes->addToRoutes('/product/{slug:\d+}', ["controller"=>"product", "action"=>"display"]);
 $routes->addToRoutes('/category/{slug:\d+}', ["controller"=>"category","action"=>"discount"]);
 $routes->addToRoutes("/drupak/pakistan/wah", ["controller" => "drup", "action" => "detail"]);
 $routes->addToRoutes('/{controller}/{id:\w+}/{action}');
// $routes->addToRoutes("/regax", ["controller" => "regax", "action" => "test"]);
// $routes->addToRoutes("/waseem/afaq/raza/wase", ["controller" => "waseem", "action" => "Programmer"]);
// $routes->addToRoutes("/showAll", ["controller" => "Articlecontroller", "action" => "showAll"]);
// $routes->addToRoutes("/Uzee", ["controller" => "Articlecontroller", "action" => "uzee"]);
// $routes->addToRoutes("/history", ["controller" => "drupak", "action" => "history"]);
// $routes->addToRoutes("/sports/cricket", ["controller" => "sports", "action" => "cricket"]);

$dispatcher = new Dispatcher($routes);
$dispatcher->handleUrl($url);





?>