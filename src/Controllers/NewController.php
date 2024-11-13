<?php

namespace App\Controllers;

use App\Models\NewModel;
use Framework\Viewer;
use Symfony\Component\VarDumper\Cloner\Data;

class NewController
{
    private Viewer $viewer;
    public function __construct(Viewer $viewer){
        $this->viewer = $viewer;
    }
    public function show()
    {
        // require "src/Model/new_model.php";
        $all_news = new NewModel();
        $all_news = $all_news->connect();
       print   $this->viewer->render("new_view",['all_news'=>$all_news]);
       
        // return $all_news;
       
        // require "View/new_view.php";


    }
}

?>