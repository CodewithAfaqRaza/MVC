<?php

use App\Middlewares\Authenticate;
use App\Middlewares\EidMiddleware;
use App\Middlewares\Trim;
use App\Middlewares\WelcomeMiddleware;

$middlewares = [
  'authenticate'=>Authenticate::class,
  'trim'=>Trim::class,
  'welcome'=>WelcomeMiddleware::class,
  'eid'=>EidMiddleware::class
];

return $middlewares;