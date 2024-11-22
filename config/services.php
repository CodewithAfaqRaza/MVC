<?php
use Framework\Container;
use App\Database;


$container = new Container;


$container->set("Framework\Database", function () {
    return new Database($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
});
return $container;