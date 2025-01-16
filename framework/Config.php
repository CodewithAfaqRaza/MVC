<?php

namespace Framework;

class Config {
    private static $settings  = [];

    private static $instance = null;

    public static function  getInstance (){
        if(self::$instance===null){
            self::$instance = new self;
        }
        return self::$instance;
    }
    public function  setSettings(string $key, $value) {
        self::$settings[$key] = $value;
    }
    public function  getSettings($key) {
        if(isset(self::$settings[$key])){
            if(is_callable(self::$settings[$key])){
               $result =  self::$settings[$key]();
               self::$settings[$key] = $result;
               return $result;
            }else{
                return self::$settings[$key];
            }
        }
        return null;
    }
    public function getSettingsArray(){
        return self::$settings;
    }


}