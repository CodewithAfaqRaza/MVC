<?php
namespace App\Controllers;

use Framework\Viewer;

  class StudentNames{
    private Viewer $viewer;
    public function __construct(Viewer $viewer){
        $this->viewer = $viewer;
    }
    public function displayNames($id){
       print  $this->viewer->render("StudentName/name", ["id"=>$id]);
    }
  }
?>