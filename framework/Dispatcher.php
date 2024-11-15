<?php

namespace Framework;
use Framework\Router;
use ReflectionMethod;
class Dispatcher
{
  private Router $router;
  public function __construct(Router $router)
  {
    $this->router = $router;
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
      $viewer = new Viewer;
      $controller = $this->returningObject($class);



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
  public function returningObject($class)
  {
    // return new $class();
    $detail = new \ReflectionClass($class);
    $constructor = $detail->getConstructor();
    $parameters = $constructor->getParameters();
    // dump($parameters);
    $paramsArray = [];
    foreach ($parameters as $params) {
      $subClass = (string) $params->getType();
      $paramsArray[] = $subClass;
      dump($paramsArray);
    }
    dump($paramsArray);
    return new $class(...$paramsArray);
  }
}