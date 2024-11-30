<?php
namespace Framework;

use Framework\Http\Response;

interface EntityInterface{
    public function new():Response;
    public function all():Response;
    public function view ($id):Response;
    public function update($id):Response;
    public function edit ($id):Response;
    public function delete ($id):Response;
    public function remove($id);

}