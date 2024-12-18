<?php

namespace Framework\Events;

use Framework\EntityController;
use Framework\EventDispatcher\Event;
use Framework\Http\Request;
use Framework\Http\Response;

class StudentAdd extends Event{
    public function __construct(public EntityController $entity)
    {
    }


}