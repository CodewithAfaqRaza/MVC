<?php

namespace App\Controllers;

use Framework\BaseController;

class Article extends BaseController
{
    public function news()
    {
        $this->response->setBody($this->twig->render("Article/article.html.twig"));
        return $this->response;
    }
}