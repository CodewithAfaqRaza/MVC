<?php

namespace App\Controllers;

use App\Models\Student as StudentModel;

use Framework\EntityController;

class Student extends EntityController

{
    private string $hobby;
    public function __construct(StudentModel $model)
    {
        parent::__construct($model);
    }

protected array $columns = [
    'name',
    'fathername',
    'email',
    'hobby'
];
public function getHobby(){
     return $this->request->post['hobby'];
}
public function getEmail(){
     return $this->request->post['email'];
}

}