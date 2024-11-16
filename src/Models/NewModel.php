<?php

namespace App\Models;
use App\Database;
// use PDO;
class NewModel
{
    // private $db;
    public function __construct(private Database $db)
    {
        // $this->db = $db;
    }
    public function connect()
    {
        $pdo = $this->db->getConnection();
        $query = "SELECT * FROM news";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $all_news = $stmt->fetchAll();
        return $all_news;


    }
}


?>