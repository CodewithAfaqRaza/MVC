<?php

namespace Framework\Template;

use Framework\Session\SessionHandler;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

class TwigFactory{
    public function __construct(private SessionHandler $sessionHandler, private string $templatePath)
    {
        
    }
    public function create ():Environment{
      $loader =  new FilesystemLoader($this->templatePath);
      $twig = new Environment($loader,[
        'debug' => true,
        'cache' => false,
      ]);
      $twig->addExtension(new DebugExtension());
      $twig->addFunction(new TwigFunction('session',[$this,'getSessionHandler']));
      return $twig;

    
    }
    public function getSessionHandler():SessionHandler{
        return $this->sessionHandler;
    }
}