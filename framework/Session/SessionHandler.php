<?php

namespace Framework\Session;


class SessionHandler  {
    private const FLASH_KEY = 'flash'; 
    public function __construct( )
    {
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
    //  $this->initFlashMessages();
    }
    public function get($key){
    return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }
    public function set($key, $value){
        $_SESSION[$key] = $value;
    }
    public function has(string $key):bool{
     return isset($_SESSION[$key]); 
    }
    public function remove( string $key){
      unset($_SESSION[$key]);
    }
 
    public function setFlash( $key,  $massage )
    {
        $flash =  $this->get(self::FLASH_KEY) ?? [];
        $flash[$key][] = $massage;
        // dump($flash);
        $this->set(self::FLASH_KEY,$flash);
    
    }
     public function hasFlash(string $key):bool
    {
        return isset($_SESSION[self::FLASH_KEY][$key]) ;
    }
    public function removeFlash()
    {
        unset($_SESSION[self::FLASH_KEY]);
    }
    public function getFlash(string $key) : array
    {
        $flash = $this->get(self::FLASH_KEY) ?? [];
        if(isset($flash[$key])){
            $messages    = $flash[$key];
            unset($flash[$key]);
            $this->set(self::FLASH_KEY,$flash);
            return $messages;
        }
        return [];
    }
    // private function initFlashMessages(): void
    // {
    //     if (!empty($_SESSION['flash'])) {
    //         foreach ($_SESSION['flash'] as $type => $messages) {
    //             foreach ($messages as $index => $message) {
    //                 unset($_SESSION['flash'][$type][$index]);
    //             }
    //         }
    //     }
    // }

}