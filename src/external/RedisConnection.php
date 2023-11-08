<?php

namespace App\external;

use App\external\base\Connection;
use Redis;

class RedisConnection implements Connection
{

    private static ?self $instance = null;

    public Redis $redis;

    private function __construct(array $arrayConnection)
    {
        $redis = new Redis();
        $redis->connect($arrayConnection['host'], $arrayConnection['port']);
        $this->redis = $redis;
    }
    public static function getInstance(array $connectionData): self
    {
        if (is_null(self::$instance)){
            self::$instance = new static($connectionData);
        }
        return self::$instance;
    }
}