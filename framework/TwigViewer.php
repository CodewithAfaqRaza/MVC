<?php

namespace Framework;
use Twig\Environment;
use Framework\Http\Response;
class TwigViewer {


    public function __construct(private Environment $twig,private Response $response) {}

    public function render(string $template, array $data = []){
        $this->response->setBody($this->twig->render($template, $data));
        return $this->response;
    }
}