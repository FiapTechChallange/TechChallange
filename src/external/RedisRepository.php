<?php

namespace App\external;

class RedisRepository
{

    private RedisConnection $connection;

    private string $namespace;

    private string $pKey;

    /**
     * @param RedisConnection $connection
     */
    public function __construct(RedisConnection $connection)
    {
        $this->connection = $connection;
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

    public function create(array $data)
    {
            return $this->connection->hMSet("{$this->namesapce}:{$data[$this->pKey]}", $data);
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

        return $this->connection->hMSet("{$this->namesapce}:{$data[$this->pKey]}", $toSave);
    }

    public function delete(string $id)
    {
        return $this->connection->mhel("{$this->namesapce}:{$id}");
    }

    public function show(string $id)
    {
        return $this->connection->hGetAll("{$this->namesapce}:{$id}");
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
            $data[$id] = $this->connection->hMGet("{$this->namesapce}:{$id}");
        }
        return $data;
    }
}