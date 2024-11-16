<?php

namespace Framework;
use Framework\Router;
use ReflectionMethod;
use ReflectionClass;
class Dispatcher
{
  private Router $router;
  private Container $container;
  public function __construct(Router $router, Container $container)
  {
    $this->router = $router;
    $this->container = $container;
  }
  public function handleUrl($url)
  {
    if ($details = $this->router->match($url)) {
      // dump($details);
      $namespace = "App\\Controllers\\";
      $className = ucwords($details['controller'], "-");
      $className = str_replace("-", "", $className);
      $class = $namespace . $className;

      $actionName = ucwords($details['action'], "-");
      $action = str_replace("-", "", $actionName);
      $actionName = lcfirst($action);

      $action = $actionName;
      // $viewer = new Viewer;
      $controller = $this->container->get($class);



      $reflectionMethod = new ReflectionMethod($controller, $action);
      $parameters = $reflectionMethod->getParameters();
      $paramsArray = [];
      foreach ($parameters as $params) {
        $paramsArray[$params->getName()] = $details[$params->getName()];
      }
      $controller->$action(...$paramsArray);
    } else {
      echo "Routes Not Found";
    }
  }

}