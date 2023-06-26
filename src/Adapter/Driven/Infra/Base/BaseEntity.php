<?php

namespace App\Adapter\Driven\Infra\Base;


use App\Adapter\Driven\Infra\Connection\Connect;
use PDO;

class BaseEntity
{
    use Connect;

    private string $table;

    private array $columns;

    private $connection;

    public $statusCode;
    public $statusMsg;

    public $collection;

    /**
     * @param $connection
     */
    public function __construct($table, $columns)
    {
        $this->connection = $this->connect();
        $this->table = $table;
        $this->columns = $columns;
    }

    public function create($data)
    {
        try {
            $insertColumns = implode(",", array_keys($data));
            $bindings = ':' . implode(", :", array_keys($data));

            $sql = "INSERT INTO {$this->table} ({$insertColumns}) VALUES ({$bindings})";
            $stmt = $this->connection->prepare($sql);

            foreach ($data as $column => $value) {
                $stmt->bindValue(":{$column}", $value);
            }

            $stmt->execute();

            $this->statusCode = 201;
            $this->statusMsg = 'success';
        } catch (\PDOException $e) {
            $this->statusCode = $e->getCode();
            $this->statusMsg = $e->getMessage();
        }

        return $this;
    }

    public function update(int $id, $data)
    {
        try {
            $updateBindings = implode(',', array_map(function ($field) {
                return $field . '=:' . $field;
            }, array_keys($data)));

            $sql = "UPDATE {$this->table} SET {$updateBindings} WHERE id={$id}";
            $stmt = $this->connection->prepare($sql);

            foreach ($data as $column => $value) {
                $stmt->bindValue(":{$column}", $value);
            }

            $stmt->execute();

            $this->statusCode = 200;
            $this->statusMsg = 'success';
        } catch (\PDOException $e) {
            $this->statusCode = $e->getCode();
            $this->statusMsg = $e->getMessage();
        }

        return $this;
    }

    public function delete(int $id)
    {
        try {
            $sql = "DELETE FROM {$this->table} WHERE id=:id";
            $stmt = $this->connection->prepare($sql);

            $stmt->bindValue(":id", $id);
            $stmt->execute();

            $this->statusCode = 204;
            $this->statusMsg = 'success';
        } catch (\PDOException $e) {
            $this->statusCode = $e->getCode();
            $this->statusMsg = $e->getMessage();
        }

        return $this;
    }

    public function show(int $id)
    {
        try {
            $sql = "SELECT * FROM {$this->table} WHERE id=:id";
            $stmt = $this->connection->prepare($sql);

            $stmt->bindValue(":id", $id);
            $stmt->execute();

            $response = $stmt->fetch(PDO::FETCH_ASSOC);

            if (empty($response)) {
                throw new \Exception("Consulta não retornou resultado", 400);
            }

            foreach ($response as $column => $value) {
                if (in_array($column, $this->columns)) {
                    $this->$column = $value;
                }
            }

//            foreach($this->relations as $key => $relations){
//                foreach($relations as $relation => $foreign ){
//                    $model = $foreign['entity']::model();
//                    $this->$relation = $model->list($foreign['column'],$this->$key);
//                }
//            }

            $this->statusCode = 200;
            $this->statusMsg = 'success';
        } catch (\PDOException $e) {
            $this->statusCode = $e->getCode();
            $this->statusMsg = $e->getMessage();
        }

        return $this;
    }

    public function list($column = null, $value = null)
    {
        try {
            $where = !is_null($column) && !is_null($value)?$column.'='.$value:'';
            $sql = "SELECT * FROM {$this->table} {$where}";
            $stmt = $this->connection->prepare($sql);

            $stmt->execute();
            $list = $stmt->fetchAll(PDO::FETCH_ASSOC);

//            if(!empty($this->relations)){
//                foreach ($list as $row){
//                    foreach($this->relations as $key => $relations){
//                        foreach($relations as $relation => $foreign ){
//                            $model = $foreign['entity']::model();
//                            $row[$relation] = $model->list($foreign['column'],$row[$key]);
//                        }
//                    }
//                }
//            }

            $this->collection = $list;

            $this->statusCode = 200;
            $this->statusMsg = 'success';
        } catch (\PDOException $e) {
            $this->statusCode = $e->getCode();
            $this->statusMsg = $e->getMessage();
        }

        return $this;
    }
}