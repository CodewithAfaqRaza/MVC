<?php

namespace Framework;

use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Session\SessionHandler;
use Framework\Template\TwigViewer;
use Framework\Viewer;
use Twig\Environment;


abstract class BaseController
{
    protected Request $request;
    protected Response $response;
    public Viewer $viewer;
    protected Environment $twig;
    protected TwigViewer $twigViewer;
    protected SessionHandler $sessionHandler;


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
    public function setSessionHandler( SessionHandler $sessionHandler){
        $this->sessionHandler = $sessionHandler;
    }


}