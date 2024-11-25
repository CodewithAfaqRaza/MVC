<?php

namespace Framework\Http;

class Response
{
    public string $body = "";
    public int $http_request_code = 0;
    public array $header = [];

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
    public function setHeader(string $header)
    {
        $this->header[] = $header;
    }
    public function send()
    {
        if ($this->http_request_code > 0) {
            http_response_code($this->http_request_code);
        }
        print $this->body;
    }
}