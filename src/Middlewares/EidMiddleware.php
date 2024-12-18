<?php

namespace App\Middlewares;

use Framework\Http\Middleware\MiddlewareInterface;
use Framework\Http\Middleware\RequestHandler;
use Framework\Http\Request;
use Framework\Http\Response;

class EidMiddleware implements MiddlewareInterface{
  public function process(Request $request, RequestHandler $requestHandler) : Response {
    // dump("This is Printed Data from the Eid Middleware");
    $response = $requestHandler->handle($request);
    $response->setBody($response->getBody()."Eid muberk");
      return $response;
  }
}