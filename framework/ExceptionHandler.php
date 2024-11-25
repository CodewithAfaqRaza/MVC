<?php
namespace Framework;
use Exception;
use Framework\Exception\RouteNotFound;
use Throwable;
class ExceptionHandler
{
    public static function errorException(Throwable $exception)
    {
        if ($exception instanceof RouteNotFound) {
            http_response_code(404);
            $template = "404";
            // throw new Exception("This is an error From ExceptionHandler");
        } else {
            $template = "500";
        }
        require BASE_PATH . "/View/{$template}.php";
    }
}