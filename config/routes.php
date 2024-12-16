<?php
use Framework\Router;
$routes = new Router;
$routes->addToRoutes('/{student}/{id:\w+}/{remove}', ["controller" => "student", "action" => "remove", "method" => "post"]);
$routes->addToRoutes('/{student}/{id:\w+}/{view}', ["controller" => "student", "action"=>"view",'middlewares'=>'authenticate|eid|welcome|trim']);
$namespace = "Admin";
$routes->addToRoutes('/{controller}/{action}');
$routes->addToRoutes('/{controller}/{id:\w+}/{action}');
$routes->addToRoutes('/admin',['controller'=>$namespace."\Admin",'action'=>'adminData']);
$routes->addToRoutes('/node/{slug:\d+}', ["controller" => "node", "action" => "display"]);
$routes->addToRoutes('/product/{slug:\d+}', ["controller" => "product", "action" => "display"]);
$routes->addToRoutes('/category/{slug:\d+}', ["controller" => "category", "action" => "discount"]);
$routes->addToRoutes("/drupak/pakistan/wah", ["controller" => "drup", "action" => "detail"]);