<?php

namespace App\Listeners;

use Framework\Events\ResponseEvent;

class HeaderResponseEventList{
    public function __invoke(ResponseEvent $event)
    {
        // dump($event);
      $response =   $event->getResponse();
      echo  $response->setBody("The Dummy cricket the Event Dispatcher");
      if(strpos($response->getBody(),'cricket')){
        $event->PropagationStopped();
        $response->setBody("Cricket is nor Allowed");
      }
    }
    
}