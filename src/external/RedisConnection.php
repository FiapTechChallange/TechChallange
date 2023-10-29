<?php

namespace App\external;

use App\external\base\Connection;

class RedisConnection implements Connection
{

    private static ?self $instance = null;

    private function __construct($uriConnection)
    {

    }
    public static function getInstance(array $connectionData): self
    {
        if (is_null(self::$instance)){
            self::$instance = new static(
                $connectionData['uriConnection']
            );
        }
        return self::$instance;
    }
}