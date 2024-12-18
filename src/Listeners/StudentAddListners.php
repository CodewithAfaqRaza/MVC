<?php

namespace App\Listeners;

use Framework\Events\StudentAdd;

class StudentAddListners{
    public function __invoke(StudentAdd $event)
    {
       $hobby = $event->entity->getHobby();
       $email = $event->entity->getEmail();
     mail($email,"This is the testing of mail function",$hobby);
    }
    
}