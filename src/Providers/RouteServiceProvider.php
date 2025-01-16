<?php

namespace App\Providers;
use Framework\Providers\ServiceProviderInterface ;
use Framework\RouterDispatcher;

class RouteServiceProvider implements ServiceProviderInterface{
    private iterable $routes = [];
    public function __construct( private RouterDispatcher $routerDispatcher)
    {  
      $this->routes =   $this->routerDispatcher->getContainer()->getConfigClass('routes');
    }
    public function register(){
      foreach($this->routes as $route =>$routeConfig){
          $this->routerDispatcher->getRouter()->addToRoutes($route,$routeConfig);
      }
    }
}