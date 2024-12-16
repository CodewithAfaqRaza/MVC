<?php

namespace App;
class DummyTest{
    public static $count;
    public function __construct()
    {
        self::$count++;
    }
}