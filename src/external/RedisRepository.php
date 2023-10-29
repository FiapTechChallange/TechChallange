<?php

namespace App\external;

class RedisRepository
{

    private RedisConnection $connection;

    /**
     * @param RedisConnection $connection
     */
    public function __construct(RedisConnection $connection)
    {
        $this->connection = $connection;
    }


    public function create(array $data)
    {
        return $this->connection->create();
    }

    public function update(int $id, array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }

    public function show(int $id)
    {
        // TODO: Implement show() method.
    }

    public function list()
    {
        // TODO: Implement list() method.
    }

    public function queryAll(string $sql, array $bindins = [])
    {
        // TODO: Implement queryAll() method.
    }

    public function query(string $sql, array $bindins = [])
    {
        // TODO: Implement query() method.
    }


}