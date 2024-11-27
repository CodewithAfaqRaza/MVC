<?php

namespace App\Controllers;

use App\Models\Article as ArticleModel;
use Framework\BaseController;

class Article extends BaseController
{

    public function __construct(protected ArticleModel $model)
    {
    }
    public function news()
    {
        $this->response->setBody($this->twig->render("Article/article.html.twig"));
        return $this->response;
    }
    public function process()
    {

        $data = [
            "title" => empty($this->request->post["title"]) ? null : $this->request->post["title"],
            "description" => empty($this->request->post["description"]) ? null : $this->request->post["description"],
        ];
        $result = $this->model->insert($data);
        dump($result);
        // $this->model->insert($this->request->post);
        // dd("The form has been submitted successfully");
    }
}