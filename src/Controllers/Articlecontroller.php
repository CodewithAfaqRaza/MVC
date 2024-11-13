<?php
namespace App\Controllers;
use \App\Models\ArticleModel;

class Articlecontroller

{
    public function show()
    {
        // // require "src/Model/article_model.php";
        $all_article = new ArticleModel();
        $all_article = $all_article->connect();

        // require "View/article_view.php";
        // dump("THiss is showing one article");

    }
    public function showAll()
    {
        dump("THiss is showing alll article");
    }
    public function uzee()
    {
        dump("THiss is showing Uzee article");
    }

}

?>