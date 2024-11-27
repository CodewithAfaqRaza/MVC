<?php

namespace Framework;

use PDO;
use App\Database;
abstract class BaseModel
{
    protected PDO $pdo;
    protected string $tableName;
    public function __construct(protected Database $db)
    {
        $class_array = explode("\\", $this::class);
        $className = array_pop($class_array);
        $this->tableName = strtolower($className);
    }

    public function insert(array $data)
    {
        dump($data);
        $columns_name = array_keys($data);
        $columns = implode(", ", $columns_name);

        $question_marks = array_fill(0, count($data), "?");
        $question_marks = implode(", ", $question_marks);

        $sql = "INSERT INTO {$this->tableName} ({$columns}) VALUES ({$question_marks})";

        dump($this->tableName, $sql);
        $this->pdo = $this->db->getConnection();

        $stmt = $this->pdo->prepare($sql);
        $i = 1;
        foreach ($data as $value) {
            $valueType = match (gettype($value)) {
                "integer" => PDO::PARAM_INT,
                "NULL" => PDO::PARAM_NULL,
                "boolean" => PDO::PARAM_BOOL,
                "double" => PDO::PARAM_STR,
                default => PDO::PARAM_STR,
            };
            $stmt->bindValue($i, $value, $valueType);
            $i++;
        }
        return $stmt->execute();

    }

    public function getTableName()
    {

        return $this->tableName;
    }
}