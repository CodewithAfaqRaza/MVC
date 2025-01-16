<?php

namespace Framework;

use Exception;
use Framework\Http\Request;
use Framework\Http\Response;

class kernel
{
  private Container $container;
  private string $env;
  public function __construct(private RouterDispatcher $routerDispatcher)
  {
    $this->env = $this->routerDispatcher->getContainer()->getConfigClass('APP_ENV');
    $this->container = $this->routerDispatcher->getContainer();
    // dump($this->env);
    // dump($this->container);
  }
  public function handle(Request $request):Response
  {
    try{
      $response =  $this->routerDispatcher->dispatch($request);
    }catch(Exception $exception){
      $response = $this->catchException($exception);
    }
    return  $response;
  }
  public function catchException($exception){
    if(in_array($this->env,['dev','test'])){
      throw new $exception;
    }
    return new Response("Server Error", 500);
  }
  public function terminate ($request, $response){
    $request->getSessionHandler()->removeFlash();
  }

}