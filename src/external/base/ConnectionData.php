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
        // TODO: Implement getDatabase() method.
    }

    public function getPdoPort(): string
    {
        // TODO: Implement getPort() method.
    }

    public function getMongoPort(): string
    {

    }

    public function getMongoHost():string
    {

    }
}