<?php
use Framework\Container;
use App\Database;


$conatiner = new Container;


$conatiner->set("Framework\Database", function () {
    return new Database("db", "db", "db", "db");
});