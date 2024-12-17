<?php

namespace App\Listeners;

use Framework\Events\ResponseEvent;

class InvaliedResponseList{
    public function __invoke(ResponseEvent $event)
    {
      // dump($event);
      $response =   $event->getResponse();
     
        echo $response->setBody($response->getBody()." The Cricket is not allowed Text From the  invalid Response");
    }
    
}