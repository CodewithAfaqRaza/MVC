<?php

namespace App\Middlewares;

use Framework\Http\Middleware\MiddlewareInterface;
use Framework\Http\Middleware\RequestHandler;
use Framework\Http\Request;
use Framework\Http\Response;

class Authenticate implements MiddlewareInterface{
    public bool $authenticate = true;
  public function process(Request $request, RequestHandler $requestHandler) : Response {
    dump("This is Printed Data from the Welcome Middleware");

    if(!($this->authenticate)){
        return new Response("Please Login ", 403);
    }
      return   $requestHandler->handle($request);
  }
}