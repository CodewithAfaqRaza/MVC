<?php

namespace App\Middlewares;

use Framework\Http\Middleware\MiddlewareInterface;
use Framework\Http\Middleware\RequestHandler;
use Framework\Http\Request;
use Framework\Http\Response;

class Trim implements MiddlewareInterface{
  public function process(Request $request, RequestHandler $requestHandler) : Response {
    $request->post  = array_map('trim',$request->post);
    return $requestHandler->handle($request);
  }
}