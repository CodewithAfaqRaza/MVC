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
        if ($result) {
          $id = $this->model->getLastInsertId();
            header("Location: /article/$id/view");
        }
        if(!$result){
          $errors = $this->model->getErrors();
         $this->response->setBody( $this->twig->render("Article/article.html.twig", ["errors" => $errors]));
             return $this->response;
        }
    }
    public function all(){
       $records = $this->model->getAll();
       $this->response->setBody($this->twig->render("Article/all.html.twig", ["records" => $records]));
       return $this->response;
    }
    public function view ($id){
        $record = $this->model->getById($id);
        if(!$record){
            header("Location: /article/all");
        }
       return $this->twigViewer->render("Article/single.html.twig", ["record" => $record]);
        
    }


}