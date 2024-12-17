<?php

namespace Framework\EventDispatcher;

class EventDispatcher implements EventDispatcherInterface{
    private array $listeners = [];
    public function dispatch(object $event)
    {
        foreach($this->getListenersForEvent($event)as $listeners){
            dump($event);
            $listeners($event);
        } 
    }
    public function getListenersForEvent(object $event):iterable{
      $eventName = get_class($event);
      if(array_key_exists($eventName,$this->listeners)){
        return $this->listeners[$eventName];
      }
      return [];
    }
    public function addListeners($event,$listeners){
        $this->listeners[$event][]= $listeners;
        // dump($this->listeners);
        return $this;
    }
}