<?php

namespace App\external;

use App\external\base\Connection;
use Redis;

class RedisConnection implements Connection
{

    private static ?self $instance = null;

    private function __construct(array $arrayConnection)
    {
        return new Redis($arrayConnection);
    }
    public static function getInstance(array $connectionData): self
    {
        if (is_null(self::$instance)){
            self::$instance = new static($connectionData);
        }
        return self::$instance;
    }
}