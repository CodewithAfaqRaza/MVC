<?php

namespace Framework;
use ErrorException;
class HandleError
{
    public static function errorHandler($errno, $errstr, $errorFile, $errorLine)
    {
        throw new ErrorException("This is an error: $errstr", $errno, E_ERROR, $errorFile, $errorLine);

    }
}