<?php

namespace App\external;

use App\interfaces\IPdoRepository;
use PDO;

class PdoRepository implements IPdoRepository
{
    private string $table;

    private array $columns;

    private $connection;

    /**
     * @param $connection
     * @param $table
     * @param $columns
     */
    public function config($connection, $table, $columns)
    {
        $this->connection = $connection;
        $this->table = $table;
        $this->columns = $columns;
    }

    public function create(array $data)
    {

        $insertColumns = implode(",", array_keys($data));
        $bindings = ':' . implode(", :", array_keys($data));

        $sql = "INSERT INTO {$this->table} ({$insertColumns}) VALUES ({$bindings})";
        $stmt = $this->connection->prepare($sql);

        foreach ($data as $column => $value) {
            $stmt->bindValue(":{$column}", $value);
        }

        $stmt->execute();

        $data['id'] = $this->connection->lastInsertId();

        return $data;
    }

    public function update(int $id, $data)
    {

        $updateBindings = implode(',', array_map(function ($field) {
            return $field . '=:' . $field;
        }, array_keys($data)));

        $sql = "UPDATE {$this->table} SET {$updateBindings} WHERE id={$id}";
        $stmt = $this->connection->prepare($sql);

        foreach ($data as $column => $value) {
            $stmt->bindValue(":{$column}", $value);
        }

        $stmt->execute();

        $data['id'] = $id;

        return $data;
    }

    public function delete(int $id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id=:id";
        $stmt = $this->connection->prepare($sql);

        $stmt->bindValue(":id", $id);
        $stmt->execute();

        return [];
    }

    public function show(int $id)
    {

        $sql = "SELECT * FROM {$this->table} WHERE id=:id";
        $stmt = $this->connection->prepare($sql);

        $stmt->bindValue(":id", $id);
        $stmt->execute();

        $response = $stmt->fetch(PDO::FETCH_ASSOC);

        $data = [];
        if($response) {
            foreach ($response as $column => $value) {
                if (in_array($column, $this->columns)) {
                    $data[$column] = $value;
                }
            }
        }

        return $data;
    }

    public function list($column = null, $value = null)
    {

        $where = !is_null($column) && !is_null($value)?" WHERE {$column}='{$value}'":"";
        $sql = "SELECT * FROM {$this->table} {$where}";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function queryAll(string $sql, array $bindins = [])
    {
        $stmt = $this->connection->prepare($sql);
        foreach($bindins as $bindKey => $bindValue){
            $stmt->bindValue($bindKey, $bindValue);
        }
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function query(string $sql, array $bindins = [])
    {
        $stmt = $this->connection->prepare($sql);
        foreach($bindins as $bindKey => $bindValue){
            $stmt->bindValue($bindKey, $bindValue);
        }
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}