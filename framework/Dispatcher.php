<?php

namespace Framework;

use App\DummyTest;
use Framework\Exception\RouteNotFound;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Router;
use Framework\Session\SessionHandler;
use Framework\Template\TwigViewer;
use ReflectionMethod;
use Twig\Environment;
// use Framework\TwigViewer;
class Dispatcher
{
  private Router $router;
  private Container $container;
  public function __construct(Router $router, Container $container)
  {
    $this->router = $router;
    $this->container = $container;
  }
  public function handleUrl(Request $request): Response
  {
    $setSessionHandler = $this->container->get(SessionHandler::class);
    // dump($setSessionHandler);
  
    $request->setSessionHandler($setSessionHandler);
    $url = parse_url($request->uri, PHP_URL_PATH);
    $method = $request->method;
    // dump($request);
    if ($details = $this->router->match($url,$method)) {
      // dump($details);
      $namespace = "App\\Controllers\\";
      // $namespace = $namespace.
      $className = ucwords($details['controller'], "-");
      $className = str_replace("-", "", $className);
      $class = $namespace . $className;

      $actionName = ucwords($details['action'], "-");
      $action = str_replace("-", "", $actionName);
      $actionName = lcfirst($action);

      $action = $actionName;
      // $viewer = new Viewer;
      $controller = $this->container->get($class);
      $viewer = $this->container->get(Viewer::class);
      $controller->setViewer($viewer);

      $controller->setRequest($request);
      $response = $this->container->get(Response::class);
      $controller->setResponse($response);

      $twig = $this->container->get(Environment::class);
      $controller->setTwig($twig);
      $twigViewer = $this->container->get(TwigViewer::class);
      $controller->setTwigViewer($twigViewer);

      $reflectionMethod = new ReflectionMethod($controller, $action);
      $parameters = $reflectionMethod->getParameters();
      $paramsArray = [];
      foreach ($parameters as $params) {
        $paramsArray[$params->getName()] = $details[$params->getName()];
      }
      // Each Action must return a Response Object
      return $controller->$action(...$paramsArray);
    } else {
      throw new RouteNotFound();
    }
  }

}