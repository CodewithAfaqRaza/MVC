<?php

namespace Framework;

use PDO;
use App\Database;
abstract class BaseModel
{
    protected PDO $pdo;
    protected string $tableName;
    protected array $errors;
    public function __construct(protected Database $db)
    {
        $this->pdo = $this->db->getConnection();
        $class_array = explode("\\", $this::class);
        $className = array_pop($class_array);
        $this->tableName = strtolower($className);
    }

    public function insert(array $data)
    {
        $this->Validate($data);
        if(!empty($this->errors)){
            return false;
        }
        $columns_name = array_keys($data);
        $columns = implode(", ", $columns_name);

        $question_marks = array_fill(0, count($data), "?");
        $question_marks = implode(", ", $question_marks);

        $sql = "INSERT INTO {$this->tableName} ({$columns}) VALUES ({$question_marks})";

        $stmt = $this->pdo->prepare($sql);
        $i = 1;
        foreach ($data as $key => $value) {
            $valueType = match (gettype($key)) {
                "integer" => PDO::PARAM_INT,
                "boolean" => PDO::PARAM_BOOL,
                "NULL" => PDO::PARAM_NULL,
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
    public function addErrors(string $error)
    {

        $this->errors[] = $error;
    }
    public function Validate(array $data)
    {
     foreach($data as $key => $value){
        if(empty($value)){
            $this->addErrors("This field is{$key} missing and is required");
        }
    }
}
   public function getAll(){
    $sql = "SELECT * FROM {$this->tableName}";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(); 
    return $records;
   }
    public function getErrors (){
        return $this->errors;
    }
    public function getById($id){
        $sql = "SELECT * FROM {$this->tableName} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
         if(!$record){
             return false;
         }
        return $record;

    }
    public function getLastInsertId(){
       return  $this->pdo->lastInsertId();
    }
    public function update($id, array $data){
        $this->Validate($data);
        if(!empty($this->errors)){
            return false;
        }
        $array_columns  = array_keys($data);
         array_walk($array_columns,function(&$value){
          $value = $value . " = ? ";
        });
        $columns = implode(", ", $array_columns);

        $sql = "UPDATE {$this->tableName} SET $columns WHERE id = ?";
        $pdo = $this->db->getConnection();
        $stmt = $pdo->prepare($sql);
        $i = 1;
        foreach ($data as $key => $value) {
            $valueType = match (gettype($key)) {
                "integer" => PDO::PARAM_INT,
                "boolean" => PDO::PARAM_BOOL,
                "NULL" => PDO::PARAM_NULL,
                default => PDO::PARAM_STR,
            };
            
            $stmt->bindValue($i, $value, $valueType);
            $i++;
        }
        $stmt->bindValue($i, $id, PDO::PARAM_INT);
        return $stmt->execute();

        
    }
    public function delete($id){
        $sql = "DELETE FROM {$this->tableName} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}