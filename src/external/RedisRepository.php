<?php

namespace App\external;

use Redis;

class RedisRepository
{

    private Redis $connection;

    private string $namespace;

    private string $pKey;

    /**
     * @param RedisConnection $connection
     */
    public function __construct(RedisConnection $connection)
    {
        $this->connection = $connection->redis;
    }

    public function setNamespace(string $namespace, string $db = ""):void
    {
        $this->namespace = $namespace;
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
    public function getPKey(): string
    {
        return $this->pKey;
    }

    public function create(array $data)
    {
        if($this->pKey == 'oid' && isset($data['_id'])){
            $data['oid'] = $data['_id']->__toString();
        }
        return $this->connection->hMSet("{$this->namespace}:{$data[$this->pKey]}", $data);
    }

    public function update(string $id, array $data)
    {
        $hash = $this->connection->hGetAll("{$this->namespace}:{$id}");

        $toSave = [];
        foreach($data as $key => $value){
            if(array_key_exists($key, $hash) && $hash[$key] != $value){
                $toSave[$key] = $value;
            }
        }

        return $this->connection->hMSet("{$this->namespace}:{$data[$this->pKey]}", $toSave);
    }

    public function delete(string $id)
    {
        return $this->connection->del("{$this->namespace}:{$id}");
    }

    public function show(string $id)
    {
        return $this->connection->hGetAll("{$this->namespace}:{$id}");
    }

    public function list(): array
    {
        $ids = $this->connection->smembers($this->namespace);
        return $this->listByIdItems($ids);
    }

    public function listByIdItems(array $idItems): array
    {
        $data = [];
        foreach($idItems as $id){
            $data[$id] = $this->connection->hGetAll("{$this->namespace}:{$id}");
        }
        return $data;
    }
}