<?php

namespace App\Middlewares;

use Framework\Http\Middleware\MiddlewareInterface;
use Framework\Http\Middleware\RequestHandler;
use Framework\Http\Request;
use Framework\Http\Response;

class WelcomeMiddleware implements MiddlewareInterface{
  public function process(Request $request, RequestHandler $requestHandler) : Response {
    // dump("This is Printed Data from the Welcome Middleware");

      return   $requestHandler->handle($request);
  }
}