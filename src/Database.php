<?php
namespace App;
use PDO;
class Database
{
    public function __construct(public $host, public string $dbname, public string $user, public string $password)
    {
    }
    public function getConnection()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8";
        $pdo = new PDO($dsn, $this->user, $this->password);
        return $pdo;
    }
}