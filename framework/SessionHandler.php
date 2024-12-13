<?php

namespace Framework;


class SessionHandler  implements SessionInterface{ 
    public function __construct( )
    {
      session_start();
     $this->initFlashMessages();
    }
    public function get($key){
    //    return  $_SESSION[$key];
    }
    public function set(string $key,string $value){
        $_SESSION[$key] = $value;
    }
    public function has(string $key):bool{
     if(!$_SESSION[$key]){
        return false;
     }else{
        return true;
     }
    }
    public function remove( string $key){
      unset($_SESSION[$key]);
    }
    public function getFlash(string $key)
    {
        $value = $_SESSION['flash'][$key] ;
        return $value;
    }
    public function setFlash(string $type, string $massage )
    {
        $_SESSION['flash'][$type][]= $massage;
    
    }
     public function hasFlash(string $key)
    {
        return isset($_SESSION['flash'][$key]) ;
    }
    public function removeFlash(string $key)
    {
        unset($_SESSION['flash'][$key]);
    }
    private function initFlashMessages(): void
    {
        if (!empty($_SESSION['flash'])) {
            foreach ($_SESSION['flash'] as $type => $messages) {
                foreach ($messages as $index => $message) {
                    unset($_SESSION['flash'][$type][$index]);
                }
            }
        }
    }

}