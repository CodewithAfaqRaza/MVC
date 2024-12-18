<?php

namespace Framework\Events;

use Framework\EventDispatcher\Event;
use Framework\Http\Request;
use Framework\Http\Response;

class ResponseEvent extends Event{
    public function __construct(
        public  Request $request,
        public Response $response
    )
    {
    }
    public function getResponse ():Response{
        return $this->response;
    }
    public function getRequest():Request{
        return $this->request;
    }

}