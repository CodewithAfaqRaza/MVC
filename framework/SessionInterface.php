<?php

namespace Framework;

use Framework\Http\Response;

interface SessionInterface{
  public function get(string $key);
  public function set( string $key, string $value) ;
  public function has(string $key):bool ;
  public function remove(string $key)  ; 

  public function getFlash(string $key );
  public function setFlash(string $type, string $massage );
  public function hasFlash(string $key);
  public function removeFlash(string $key);

}