<?php

namespace Framework;

use App\DummyTest;
use Framework\Exception\RouteNotFound;
use Framework\Http\Middleware\RequestHandler;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Router;
use Framework\Session\SessionHandler;
use Framework\Template\TwigViewer;
use ReflectionMethod;
use Twig\Environment;
// use Framework\TwigViewer;
class kernel
{
  private Router $router;
  private Container $container;
  private array $middlewares;
  public function __construct(Router $router, Container $container,array $middlewares)
  {
    $this->router = $router;
    $this->container = $container;
    $this->middlewares = $middlewares;
  }
  public function handle(Request $request): Response
  {
    //  dump($this->middlewares);
   
    $setSessionHandler = $this->container->get(SessionHandler::class);
    // dump($setSessionHandler);
    // dump($this->requestHandler);
    $request->setSessionHandler($setSessionHandler);
    $url = parse_url($request->uri, PHP_URL_PATH);
    $method = $request->method;
    // dump($request);
    if ($details = $this->router->match($url,$method)) {
      // dump($details);
      $namespace = "App\\Controllers\\";
      // $namespace = $namespace.
      $className = ucwords($details['controller'], "-");
      $className = str_replace("-", "", $className);
      $class = $namespace . $className;
  

      $actionName = ucwords($details['action'], "-");
      $action = str_replace("-", "", $actionName);
      $actionName = lcfirst($action);

      $action = $actionName;
      // $viewer = new Viewer;
      $controller = $this->container->get($class);
      $viewer = $this->container->get(Viewer::class);
      $controller->setViewer($viewer);

      $controller->setRequest($request);
      $response = $this->container->get(Response::class);
      $controller->setResponse($response);

      $twig = $this->container->get(Environment::class);
      $controller->setTwig($twig);
      $twigViewer = $this->container->get(TwigViewer::class);
      $controller->setTwigViewer($twigViewer);

      $reflectionMethod = new ReflectionMethod($controller, $action);
      $parameters = $reflectionMethod->getParameters();
      $paramsArray = [];
      foreach ($parameters as $params) {
        $paramsArray[$params->getName()] = $details[$params->getName()];
      }
   
      $controllerHandler = new ControllerHandler($controller,$action,$paramsArray);
      if(array_key_exists('middlewares',$details)){
        $detailsMiddlewaresArray  =  explode("|",$details['middlewares']);
       
            array_walk($detailsMiddlewaresArray,function(&$value){
              if(array_key_exists($value,$this->middlewares)){
                $middlewareClass =  $this->middlewares[$value];
                $value =  $this->container->get($middlewareClass);
              }
            });
        
      }
      $requestHandler = new RequestHandler($controllerHandler);
      if(!empty($detailsMiddlewaresArray)){
        $requestHandler->middlewares = $detailsMiddlewaresArray;

      }
      return $requestHandler->handle($request);
      // return $controller->$action(...$paramsArray);
    } else {
      throw new RouteNotFound();
    }
  }

}