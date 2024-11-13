<?php

namespace Framework;
use Framework\Router;
use ReflectionMethod;
class Dispatcher{
    private Router $router;
    public function __construct(Router $router){
       $this->router = $router;
    }
    public function handleUrl($url){
        if ($details = $this->router->match($url)) {
          dump($details);
            $namespace = "App\\Controllers\\";
            $classname = ucwords($details['controller'],"-");
            $classname = str_replace("-","", $classname);
            $class = $namespace . $classname;
          
              $actionname = ucwords($details['action'],"-");
              $action = str_replace("-","", $actionname);
              $actionname = lcfirst($action);
           
              $action = $actionname;
              $viewer = new Viewer;
            $controller = new $class($viewer);
            $reflectionMethod = new ReflectionMethod($controller, $action);
            $parameters =  $reflectionMethod->getParameters();
            $paramsArray = [];
              foreach($parameters as $params ){
                $paramsArray[$params->getName()] =$details[$params->getName()];
              }
            $controller->$action(...$paramsArray);
        } else {
            echo "Routes Not Found";
        }
    }
}