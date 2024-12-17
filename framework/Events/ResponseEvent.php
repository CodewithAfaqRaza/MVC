<?php

namespace Framework\Events;

use Framework\EventDispatcher\Event;
use Framework\Http\Request;
use Framework\Http\Response;

class ResponseEvent extends Event{
    public function __construct(
        private Request $request,
        private Response $response
    )
    {
    }
    public function getResponse (){
        return $this->response;
    }
    public function getRequest(){
        return $this->request;
    }

}