<?php

namespace Framework\EventDispatcher;

abstract class Event implements StoppableEventInterface{
     public bool $isStopped = false;

    public function isPropagationStopped(): bool{
        return $this->isStopped;
    }

    public function PropagationStopped(){
        $this->isStopped = true;
    }
}