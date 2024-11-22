<?php

namespace Framework;
class EnvReader
{
    public function reader($path)
    {
        $file = file($path, FILE_IGNORE_NEW_LINES);

        foreach ($file as $line) {
            $array = explode('=', $line);
            list($key, $value) = $array;
            $_ENV[$key] = $value;

        }
    }
}