<?php
namespace Framework;
use ReflectionClass;
use ReflectionFunction;

class Container
{
    public static  $count ;
    private $binding = [];
    public   $initialized = [];
    private Config $config;

    public function set($class, $value)
    {
        $this->binding[$class] = $value;
    }
    public function get($class)
    {
     if(array_key_exists($class,$this->initialized)){
        return $this->initialized[$class];
     }

        if (array_key_exists($class, $this->binding)) {

            $ref = new ReflectionFunction($this->binding[$class]);

            if (!empty($ref->getParameters())) {
                $params = ($ref->getParameters());
                $parameters = [];
                foreach ($params as $param) {
                    $type = $param->getType()->getName();
                    $parameters[] = $this->get($type);
                }
                // dump($parameters);

                return $this->binding[$class](...$parameters);
            } else {
                return $this->binding[$class]();

            }

        }
        $detail = new ReflectionClass($class);
        // dump($detail);
        // dump($detail);
        if ($detail->getConstructor() === null) {
            $newClass = new $class();
            $this->initialized[$class] = $newClass;
            return $newClass;
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
        $mainClass = new $class(...$paramsArray);
        $this->initialized[$class] = $mainClass;
        return $mainClass;
    }
    public function  setConfig($config) {
        $this->config = $config;
    }
    public function  getConfig() {
       return  $this->config;
    }
    public function setConfigClass ($key,$value){
        $this->getConfig()->setSettings($key,$value);
    }
    public function  getConfigClass($key) {
       return  $this->getConfig()->getSettings($key) ?? null;
    }
 

}