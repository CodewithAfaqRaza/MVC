<?php

namespace App\Models;
use PDO;
class NewModel
{
    public function connect()
    {
        $dsn = "mysql:host=db;dbname=db;charset=utf8";
        $pdo = new PDO($dsn, 'db', 'db');
        $query = "SELECT * FROM news";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $all_news = $stmt->fetchAll();
        return $all_news;


    }
}


?>