<?php

namespace Framework\Http;

class Response
{
    public string $body = "";
    public int $http_request_code = 0;
    public array $headers = [];

    public function __construct( string $body = "", int $code = 200)
    {
        $this->setBody($body);
        $this->setHttpCode($code);
    }

    public function setBody(string $body)
    {
        $this->body = $body;
    }
    public function setHttpCode(int $code)
    {
        $this->http_request_code = $code;

    }
    public function getBody()
    {
        return $this->body;
    }
    public function getHttpCode()
    {
        return $this->http_request_code;
    }
    public function setHeader($key , $value)
    {
        $this->headers[$key] = $value;
    }
    public function getHeader($key)
    {
       return  $this->headers[$key];
    }
    public function send()
    {
        ob_start();
        if ($this->http_request_code > 0) {
            http_response_code($this->http_request_code);
        }
        foreach($this->headers as $key => $header){
            header($key . ": " . $header);
        }
        print $this->body;
        ob_end_flush(); 
    }
}