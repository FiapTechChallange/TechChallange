<?php

namespace App\external\base;

use App\external\base\Connect;
use PDO;

abstract class ConnectionData
{
    public function getDsn(): string
    {
        return $_ENV['DB_DSN'];
    }

    public function getPdoUsername(): string
    {
        return $_ENV['DB_USERNAME'];
    }

    public function getPdoPassword(): string
    {
        return $_ENV['DB_PASSWORD'];
    }

    public function getPdoOptions(): array
    {
        return [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    }

    public function getMongoDatabase(): string
    {
        return $_ENV['MONGO_DATABASE'];
    }

    public function getPdoPort(): string
    {
        // TODO: Implement getPort() method.
    }

    public function getMongoPort(): string
    {
        return $_ENV['MONGO_PORT'];
    }

    public function getMongoHost():string
    {
        return $_ENV['MONGO_HOST'];
    }

    public function getMongoUsername():string
    {
        return $_ENV['MONGO_USERNAME'];
    }

    public function getMongoPassword():string
    {
        return $_ENV['MONGO_PASSWORD'];
    }

    public function getRedisHost():string
    {
        return $_ENV['REDIS_HOST'];
    }

    public function getRedisPort():string
    {
        return $_ENV['REDIS_PORT'];
    }

    public function getRedisDatabase():string
    {
        return $_ENV['REDIS_DATABASE'];
    }
}