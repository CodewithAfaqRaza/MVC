<?php

namespace Framework;

use App\Models\Entity as EntityModel;
use Framework\BaseController;
use Framework\Exception\RouteNotFound;
use Framework\Http\RedirectResponse;
use Framework\Http\Response;

class EntityController extends BaseController implements EntityInterface {
    protected string $filename;
    protected string $filepart;
    protected array $columns ;
    // protected SessionHandler $session;
    public function __construct(protected EntityModel $model)
    {
        $this->filename = strtolower($this->model->getTableName());
        $this->filepart= ucfirst($this->model->getTableName());
        //  $this->session = new SessionHandler();
         
    }
    public function new():Response
    {
        // $this->session->set('entity', "The Entity has been inserted Succesfully");
        $csrf_token = $this->request->getSessionHandler()->CsrfToken();
       return $this->twigViewer->render("{$this->filename}/new.html.twig", ["csrf_token" => $csrf_token]);
        // return $this->response;
    }
    public function getColumns(){
        return  $this->columns;
    }
    public function process()
    {
        $session_csrf_token = $this->request->getSessionHandler()->get('csrf_token');
        $form_csrf_token = $this->request->post['_token'];
        if (!hash_equals($session_csrf_token,$form_csrf_token)) {
            throw new RouteNotFound("This {$this->filename} does not exits");
        }
        $data = [];
        foreach ($this->getColumns() as $column) {
            $data[$column] = $this->request->post[$column];
        }
        $result = $this->model->insert($data);
        if ($result) {
          $id = $this->model->getLastInsertId();
          $this->request->getSessionHandler()->setFlash('success', "The Entity with {$id} has been inserted Succesfully");
          return new RedirectResponse("/{$this->filename}/$id/view");
            // header("Location: /{$this->filename}/$id/view");
        }
        if(!$result){
          $errors = $this->model->getErrors();
         $this->response->setBody( $this->twig->render("{$this->filename}/new.html.twig", ["errors" => $errors]));
             return $this->response;
        }
    }
    public function all():Response{
       $records = $this->model->getAll();
       

       $this->response->setBody($this->twig->render("{$this->filename}/all.html.twig", ["records" => $records]));
       return $this->response;
    }
    public function view ($id):Response{
        $record = $this->model->getById($id);
        if(!$record){
            header("Location: /{$this->filename}/all");
        }
       return $this->twigViewer->render("{$this->filename}/single.html.twig", ["record" => $record]);
        
    }
    public function update($id):Response{
       
        $data = [];
        foreach ($this->getColumns() as $column) {
            $data[$column] = $this->request->post[$column];
        }
    $record = $this->model->getById($id);
        if($record){
           $status =  $this->model->update($id, $data);
           if($status){
            header("Location: /{$this->filename}/$id/view");
           }else{
          return   $this->twigViewer->render("{$this->filename}/update.html.twig", ["record" => $data, "errors" => $this->model->getErrors()]);

           }
        }     else{
            throw new RouteNotFound("This {$this->filename} does not exits");
        }
    }
    public function edit ($id):Response{
    $record = $this->model->getById($id);
        if($record){
          return   $this->twigViewer->render("{$this->filename}/update.html.twig", ["record" => $record]);
        } else{
            throw new RouteNotFound("This {$this->filename} does not exits");
        }
    }
    public function delete($id):Response{
    $record = $this->getRecord($id);
    if(!$record){
        throw new RouteNotFound("This {$this->filename} does not exits");
    }
    return $this->twigViewer->render("{$this->filename}/delete.html.twig", ["record" => $record]);
    }
    public function remove($id){
        $record = $this->getRecord($id);
        $status = $this->model->delete($id);
        if($status){
            header("Location: /{$this->filename}/all");
        }
    }
    public function getRecord($id){
        $record = $this->model->getById($id);
        if(!$record){
            throw new RouteNotFound("This {$this->filename} does not exits");
            }
            return $record;
    }
}