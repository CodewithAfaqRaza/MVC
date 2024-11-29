<?php

namespace Framework;

use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Viewer;
use Twig\Environment;


abstract class BaseController
{
    protected Request $request;
    protected Response $response;
    public Viewer $viewer;
    protected Environment $twig;
    protected TwigViewer $twigViewer;

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }
    public function setResponse(Response $response)
    {
        $this->response = $response;
    }
    public function setViewer(Viewer $viewer)
    {
        $this->viewer = $viewer;
    }
    public function setTwig(Environment $twig)
    {
        $this->twig = $twig;
    }
    public function setTwigViewer(TwigViewer $twigviewer)
    {
        $this->twigViewer = $twigviewer;
    }


}