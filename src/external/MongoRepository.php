<?php

namespace App\external;

use MongoDB\BSON\ObjectId;
use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;

class MongoRepository
{
    private Manager $connection;

    private String $namespace;

    private string $lastInsertId;

    private string $pKey;

    public function __construct(MongoConnection $connection)
    {
        $this->connection = $connection->manager;
    }

    public function getId()
    {
        return new ObjectId();
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

        $query = new Query(['_id' => new ObjectId($id)]);
        $inserted = $this->connection->executeQuery($this->namespace, $query)->toArray()[0];
        $this->setLastInsertId($inserted->_id->__toString());

        return $write->getInsertedCount();
    }

    public function update(string $id, array $data, $pKey = null, $expToUpdate = [])
    {
        $pkey = $pkey ?? $this->pKey;
        $query = $pkey == 'oid'?new Query(['_id' => new ObjectId($id)]):new Query([$pKey => ['$eq' => $id]]);

        unset($data['oid']);
        $expToUpdate = empty($expToUpdate)?['$set' => $data]:$expToUpdate;
        $bulk = new BulkWrite();
        $bulk->update($query, $expToUpdate);

        $write = $this->connection->executeBulkWrite($this->namespace, $bulk);

        return $write->getModifiedCount();
    }


    public function delete(string $id)
    {
        $bulk = new BulkWrite();
        $query = $this->pKey == 'oid'?new Query(['_id' => new ObjectId($id)]):new Query([$this->pKey => ['$eq' => $id]]);
        $bulk->delete($query);
        $write = $this->connection->executeBulkWrite($this->namespace, $bulk);

        return $write->getDeletedCount();
    }

    public function show(string $id)
    {
        $query = $this->pKey == 'oid'?new Query(['_id' => new ObjectId($id)]):new Query([$this->pKey => ['$eq' => $id]]);

        return (array)$this->connection->executeQuery($this->namespace, $query)->toArray()[0];
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