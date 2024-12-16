<?php
namespace Framework;

use Framework\Http\Middleware\RequestHandlerInterface;
use Framework\Http\Request;
use Framework\Http\Response;

class ControllerHandler implements RequestHandlerInterface{
     
    public function __construct(
        private BaseController $controller,
        private string $action,
        private array $params
    )
    {
        
    }

    public function handle(Request $request): Response
    {
        return ($this->controller)->{$this->action}(...$this->params);
    }
}