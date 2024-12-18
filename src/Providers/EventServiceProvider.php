<?php

namespace App\Providers;

use App\Listeners\HeaderResponseEventList;
use App\Listeners\InvaliedResponseList;
use App\Listeners\StudentAddListners;
use Framework\EventDispatcher\EventDispatcher;
use Framework\Events\ResponseEvent;
use Framework\Events\StudentAdd;
use Framework\Providers\ServiceProviderInterface ;


class EventServiceProvider implements ServiceProviderInterface{
    private iterable $listeners = [
        ResponseEvent::class=>[
            HeaderResponseEventList::class,
            InvaliedResponseList::class
        ],
        StudentAdd::class=>[
            StudentAddListners::class
        ]
    ];
    public function __construct( private EventDispatcher $eventDispatcher)
    {  
    }
    public function register(){
      foreach($this->listeners as $eventName =>$listeners){
        foreach($listeners as $listener){
            $this->eventDispatcher->addListeners($eventName,new $listener);
        }
      }
    }
}