<?php

namespace App\Controllers;

use App\Models\Student as StudentModel;

use Framework\EntityController;

class Student extends EntityController
{
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

}