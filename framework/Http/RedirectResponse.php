<?php
namespace Framework\Http;

use Framework\Http\Response;

class RedirectResponse extends Response{
   public function __construct(string $url)
   {
    parent::__construct();
    $this->setHeader("Location",$url);
   }
}