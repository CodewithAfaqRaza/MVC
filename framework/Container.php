<?php
namespace Framework;
use ReflectionClass;

class Container
{
    private $binding = [];
    public function set($class, $value)
    {
        $this->binding[$class] = $value;
    }
    public function get($class)
    {
        if (array_key_exists($class, $this->binding)) {
            return $this->binding[$class]();
        }
        $detail = new ReflectionClass($class);
        if ($detail->getConstructor() === null) {
            return new $class();
        }
        $constructor = $detail->getConstructor();
        $parameters = $constructor->getParameters();
        // dump($parameters);
        $paramsArray = [];
        foreach ($parameters as $params) {
            if ($params->getType() === null) {
                dd("You must have to add the type with Constructor " . $params->getName() . " Arguments");
            }
            $subClass = (string) $params->getType();
            $paramsArray[] = $this->get($subClass);
            // dump($subClass);
        }
        // dump($paramsArray);
        // exit;
        return new $class(...$paramsArray);
    }
}