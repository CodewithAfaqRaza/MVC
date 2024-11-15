<?php
namespace App\Controllers;
use App\Models\NewModel;
use Framework\Viewer;

class ReflectionMethod
{
    private Viewer $viewer;
    private NewModel $newModel;
    public function __construct(Viewer $viewer, NewModel $newModel)
    {
        $this->viewer = $viewer;
        $this->newModel = $newModel;


    }
}