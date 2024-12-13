<?php

namespace App\Controllers\Admin;

use Framework\BaseController;
use Framework\Http\Response;
use Framework\TwigViewer;

class Admin extends BaseController{
    public function __construct(protected TwigViewer $twigViewer)
    {
        
    }
    public function adminData(){
        // dump("afaq");
        return $this->twigViewer->render('admin.html.twig',['records'=>['user1'=>'afaq','user2'=>'waseem']]);
    }
}