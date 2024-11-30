<?php

namespace Framework;

use App\Models\Article as ArticleModel;
use Framework\BaseController;
use Framework\Exception\RouteNotFound;
use Framework\Http\Response;

class EntityController extends BaseController implements EntityInterface {
    
    public function __construct(protected ArticleModel $model)
    {
    }
    public function new():Response
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
    public function all():Response{
       $records = $this->model->getAll();
       $this->response->setBody($this->twig->render("Article/all.html.twig", ["records" => $records]));
       return $this->response;
    }
    public function view ($id):Response{
        $record = $this->model->getById($id);
        if(!$record){
            header("Location: /article/all");
        }
       return $this->twigViewer->render("Article/single.html.twig", ["record" => $record]);
        
    }
    public function update($id):Response{
        $data = [
            // "title"=>empty($this->request->post['title']?null: $this->request->post['title']),

            // "description"=>empty($this->request->post['description']?null: $this->request->post['descriptions'])
            "title"=>$this->request->post['title'],
            "description"=>$this->request->post['description'],
        ];
    $record = $this->model->getById($id);
        if($record){
           $status =  $this->model->update($id, $data);
           if($status){
            header("Location: /article/$id/view");
           }else{
          return   $this->twigViewer->render("Article/update.html.twig", ["record" => $record, "errors" => $this->model->getErrors()]);

           }
        }     else{
            throw new RouteNotFound("This article does not exits");
        }
    }
    public function edit ($id):Response{
    $record = $this->model->getById($id);
        if($record){
          return   $this->twigViewer->render("Article/update.html.twig", ["record" => $record]);
        } else{
            throw new RouteNotFound("This article does not exits");
        }
    }
    public function delete($id):Response{
    $record = $this->getRecord($id);
    if(!$record){
        throw new RouteNotFound("This article does not exits");
    }
    return $this->twigViewer->render("Article/delete.html.twig", ["record" => $record]);
    }
    public function remove($id){
        $record = $this->getRecord($id);
        $status = $this->model->delete($id);
        if($status){
            header("Location: /article/all");
        }
    }
    public function getRecord($id){
        $record = $this->model->getById($id);
        if(!$record){
            throw new RouteNotFound("This article does not exits");
            }
            return $record;
    }
}