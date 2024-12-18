<?php

namespace App\Listeners;

use Framework\Events\ResponseEvent;

class HeaderResponseEventList{
    public function __invoke(ResponseEvent $event)
    {
        // dump($event);
      $response =   $event->getResponse();
      if(strpos($response->getBody(),'hobby')){
        $event->PropagationStopped();
      }
      $response->setBody($response->getBody()." Message From the Second That Interests is not allowed");
    }
    
}