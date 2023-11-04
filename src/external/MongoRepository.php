<?php

namespace App\external;

use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;

class MongoRepository
{
    private MongoConnection $connection;

    private String $namespace;

    private string $lastInsertId;

    private string $pKey;

    public function __construct(MongoConnection $connection)
    {
        $this->connection = $connection;
    }

    public function getId()
    {
        return new \MongoDB\BSON\ObjectId();
    }

    public function setNamespace(string $collection, string $db):void
    {
        $this->namespace = "{$db}.{$collection}";
    }

    /**
     * @param string $pKey
     */
    public function setPKey(string $pKey): void
    {
        $this->pKey = $pKey;
    }

    /**
     * @return string
     */
    public function getLastInsertId(): string
    {
        return $this->lastInsertId;
    }

    /**
     * @param string $lastInsertId
     */
    public function setLastInsertId(string $lastInsertId): void
    {
        $this->lastInsertId = $lastInsertId;
    }



    public function create(array $data)
    {
        $bulk = new BulkWrite();
        $id = $bulk->insert($data);
        $write = $this->connection->executeBulkWrite($this->namespace, $bulk);

        $inserted = $this->show($id);
        $this->setLastInsertId($inserted[$this->pKey]);

        return $write->getInsertedCount();
    }

    public function update(string $id, array $data, $pKey = null, $op = '$set')
    {
        $pkey = $pkey ?? $this->pKey;
        $bulk = new BulkWrite();
        $bulk->update([$pKey => ['&eq' => $id]], [$op => $data]);
        $write = $this->connection->executeBulkWrite($this->namespace, $bulk);

        return $write->getModifiedCount();
    }


    public function delete(string $id)
    {
        $bulk = new BulkWrite();
        $bulk->delete([$this->pKey => ['&eq' => $id]]);
        $write = $this->connection->executeBulkWrite($this->namespace, $bulk);

        return $write->getDeletedCount();
    }

    public function show(string $id)
    {
        $query = new Query([$this->pKey => ['&eq' => $id]]);

        return $this->connection->executeQuery($this->namespace, $query)->toArray();
    }

    public function list()
    {
        $query = new Query([]);

        return $this->connection->executeQuery($this->namespace, $query)->toArray();
    }

    public function query(array $filter)
    {
        $query = new Query($filter);

        return $this->connection->executeQuery($this->namespace, $query)->toArray();
    }
}