<?php

namespace Framework;

class     Router
{
    public array $routesArray = [];
    public function addToRoutes($path, $details = [])
    {
        $this->routesArray[$path] = $details;
    }
    public function match($path): array|bool
    {
      $path = trim($path,"/");// remove leading and trailing slashes

      // Foreach Loop
        foreach($this->routesArray as $route => $details) {
 
          $pattern = $this->changeRouteToRegax($route);

          if (preg_match($pattern, $path, $matches)) {
            $matches = array_filter($matches,"is_string",ARRAY_FILTER_USE_KEY);
            $combine_array = $matches + $details;
            return $combine_array;
          }else{
          }
        }
        if (array_key_exists($path, $this->routesArray)) {
            return $this->routesArray[$path];
        }
        return false;
    }
    private function changeRouteToRegax($route){
        // dump($route);
        $route = trim($route, "/"); 
        $elements = explode("/", $route);
        $elements = array_map(function($element) {
            $pattern = "#^\{([a-z][a-z0-9]*)\}$#";
            if(preg_match($pattern, $element, $matches,)){
               return "(?<".$matches[1].">[a-z][a-z0-9-_]*)";
            }
            $pattern_slug="#^\{([a-z][a-z0-9]*):(.*)\}$#";
            if(preg_match($pattern_slug, $element, $matches,)){
           
               return "(?<".$matches[1].">".$matches[2].")";
            }
            return $element;
        },$elements);
        $regax = implode("/", $elements);
        $pattern = "#^".$regax."$#";
        dump($pattern);
        return $pattern;
    }
}