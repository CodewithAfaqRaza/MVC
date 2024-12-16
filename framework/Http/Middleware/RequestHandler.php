<?php
namespace Framework\Http\Middleware;

use App\Middlewares\Authenticate;
use App\Middlewares\EidMiddleware;
use App\Middlewares\Trim;
use App\Middlewares\WelcomeMiddleware;
use Framework\ControllerHandler;
use Framework\Http\Request;
use Framework\Http\Response;

class RequestHandler implements RequestHandlerInterface{

    public  array $middlewares = [];
    public function __construct(private ControllerHandler $controllerHandler)
    {
        
    }
    public function handle(Request $request):Response
    {
        if(empty($this->middlewares)){
            return  $this->controllerHandler->handle($request);
        }
        $middleware = array_shift($this->middlewares);
        // dd($class);
        // $middleware = new $class;
        // dump($middleware);
       return  $middleware->process($request,$this);
    }
}