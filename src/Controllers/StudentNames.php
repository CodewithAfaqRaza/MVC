<?php
namespace App\Controllers;

use Framework\BaseController;
use Framework\Http\Response;
use Framework\Viewer;

class StudentNames extends BaseController
{

  public function displayNames($id): Response
  {
    // print $this->viewer->render("partials/header", ["title" => "Names"]);
    $this->response->setBody($this->viewer->render("StudentName/name", ["id" => $id]));
    return $this->response;
    // print $this->viewer->render("StudentName/name", ["id" => $id]);
    // print $this->viewer->render("partials/Footer");
  }
  public function displayMotherName($id): Response
  {
    $this->response->setHttpCode(451);
    $this->response->setBody("<h1>The Student mother name is Not allowed to print  </h1>");
    return $this->response;
  }
  public function testTwig($id)
  {
    print $this->twig->render("test.html.twig", [
      "id" => $id,
      "fruits" => ["istanbul" => "apple", "ankara" => "banana"],
      "hacked" => '<script>alert("You have Been Hacked")</script>',
      "title" => "Twig",


    ]);

    exit;
  }
}
?>