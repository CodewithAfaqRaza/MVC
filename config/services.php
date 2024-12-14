<?php
use Framework\Container;
use App\Database;
use Framework\Session\SessionHandler;
use Twig\Environment;
use Framework\Template\TwigFactory;

$container = new Container();


$container->set(Database::class, function () {
    return new Database($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
});
// this is the file Environment  classes 
$sessionHandler = $container->get(SessionHandler::class); 
$container->set(Environment::class, function () use($sessionHandler):Environment{
$twigFactory = new TwigFactory(new SessionHandler,BASE_PATH ."/templates");
return $twigFactory->create();
});
return $container;