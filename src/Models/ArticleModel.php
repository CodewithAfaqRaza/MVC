<?php

namespace App\Models;
use PDO;
class ArticleModel
{
    public function connect()
    {

        $dsn = "mysql:host=db;dbname=db;charset=utf8";
        $pdo = new PDO($dsn, 'db', 'db');
        $query = "SELECT * FROM articles";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $all_article = $stmt->fetchAll();
        return $all_article;


    }
}


?>