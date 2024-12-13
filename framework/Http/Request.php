<?php

namespace Framework\Http;

use Framework\Session\SessionHandler;

class Request
{
    private SessionHandler $sessionHandler;
    public function __construct(


        public string $uri,
        public string $method,
        public array $get,
        public array $post,
        public array $files,
        public array $cookie,
        public array $server
    ) {
    }
    public static function createFromGlobals()
    {
        return new static($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD'], $_GET, $_POST, $_FILES, $_COOKIE, $_SERVER);
    }
    public function setSessionHandler(SessionHandler $sessionHandle){
        $this->sessionHandler = $sessionHandle;
    }
    public function getSessionHandler( ):SessionHandler{
       return $this->sessionHandler;
    }
}