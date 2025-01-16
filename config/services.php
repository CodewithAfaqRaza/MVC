<?php
use Framework\Container;
use App\Database;
use Framework\Config;
use Framework\EnvReader;
use Framework\Http\Response;
use Framework\RouterDispatcher;
use Framework\Session\SessionHandler;
use Twig\Environment;
use Framework\Template\TwigFactory;

$container = new Container();
$envReader = $container->get(EnvReader::class);

$config = $container->get(Config::class);

$config->setSettings('basePath',dirname(__DIR__));

$envReader->reader($config->getSettings('basePath') . "/" . ".env");
$config->setSettings('APP_ENV',$_ENV['APP_ENV']);
$config->setSettings('middlewares',function(){
  return require BASE_PATH ."/config/middlewares.php";
});
$config->setSettings('routes',function() use($config){
  return require $config->getSettings('basePath') ."/config/routes.php";
});

$container->setConfig($config);


$container->set(Database::class, function () {
    return new Database($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
});
// this is the file Environment  classes 
$sessionHandler = $container->get(SessionHandler::class); 
$container->set(Environment::class, function () use($sessionHandler):Environment{
$twigFactory = new TwigFactory($sessionHandler,BASE_PATH ."/templates");
return $twigFactory->create();
});

$container->set(Response::class,function(){
    return new Response();
});

$routerDispatcher = $container->get(RouterDispatcher::class);
$routerDispatcher->setContainer($container);
$routerDispatcher->setMiddleWare($container->getConfigClass('middlewares'));

return $container;