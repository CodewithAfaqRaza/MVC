<?php

namespace App\Listeners;

use Framework\Events\ResponseEvent;

class InvaliedResponseList{
    public function __invoke(ResponseEvent $event)
    {
      // dump($event);
      $response =   $event->getResponse();
     
       $response->setBody($response->getBody()." The Message  From the  invalid Response");
    }
    
}