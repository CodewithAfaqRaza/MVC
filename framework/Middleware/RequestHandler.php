<?php
namespace Framework\Http\Middleware;

use Framework\Http\Request;
use Framework\Http\Response;

class RequestHandler implements RequestHandlerInterface{

    public array $middlewares = [];
    public function handle(Request $request):Response
    {
        // return $request;
    }
}