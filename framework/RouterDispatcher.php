<?php

namespace Framework;

use App\DummyTest;
use Framework\EventDispatcher\EventDispatcher;
use Framework\Events\ResponseEvent;
use Framework\Exception\RouteNotFound;
use Framework\Http\Middleware\RequestHandler;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Router;
use Framework\Session\SessionHandler;
use Framework\Template\TwigViewer;
use ReflectionMethod;
use Twig\Environment;
class RouterDispatcher
{
  private Router $router;
  private Container $container;
  private array $middlewares;
  private EventDispatcher $eventDispatcher;
  public function __construct(Router $router,EventDispatcher $eventDispatcher)
  {
    $this->router = $router;
    $this->eventDispatcher = $eventDispatcher;
  }
  public function dispatch(Request $request):Response
  {
    $setSessionHandler = $this->container->get(SessionHandler::class);

    $request->setSessionHandler($setSessionHandler);
    $url = parse_url($request->uri, PHP_URL_PATH);
    $method = $request->method;

    if ($details = $this->router->match($url,$method)) {
      // get the className Function///
     $class =  $this->getClassName($details);
      
      // get the ActionName Function///
       $action =    $this->getActionName($details);
      
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
      $controller->setEventDispatcher($this->eventDispatcher);
      $reflectionMethod = new ReflectionMethod($controller, $action);
      $parameters = $reflectionMethod->getParameters();
      $paramsArray = [];
      foreach ($parameters as $params) {
        $paramsArray[$params->getName()] = $details[$params->getName()];
      }
      $controllerHandler = new ControllerHandler($controller,$action,$paramsArray);
      $requestHandler = new RequestHandler($controllerHandler);

      // This is the Function That handle the MiddleWares 
        $this->setMiddleWares($details,$requestHandler);

      $response = $requestHandler->handle($request);
      $this->eventDispatcher->dispatch(new ResponseEvent($request, $response));
      return $response;
    } 
  }
  private function getClassName($details){
    $namespace = "App\\Controllers\\";
      $className = ucwords($details['controller'], "-");
      $className = str_replace("-", "", $className);
      $class = $namespace . $className;
      return $class;
  }
  private function getActionName($details){
    $actionName = ucwords($details['action'], "-");
    $action = str_replace("-", "", $actionName);
    $actionName = lcfirst($action);
    return  $actionName;
   
  }
  
  private function  setMiddleWares($details,$requestHandler){
    if(array_key_exists('middlewares',$details)){
      $detailsMiddlewaresArray  =  explode("|",$details['middlewares']);
          array_walk($detailsMiddlewaresArray,function(&$value){
            if(array_key_exists($value,$this->middlewares)){
              $middlewareClass =  $this->middlewares[$value];
              $value =  $this->container->get($middlewareClass);
            }
          });
    }
    if(!empty($detailsMiddlewaresArray)){
      $requestHandler->middlewares = $detailsMiddlewaresArray;
    }
  }
  public  function setContainer( $container){
    $this->container = $container;
  }
  public  function getContainer(){
    return $this->container;
  }
  public  function getRouter(){
    return $this->router;
  }
  public function setMiddleWare($middleware){  
    $this->middlewares = $middleware;
  }

}