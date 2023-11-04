<?php

namespace App\external;

use App\external\base\Connection;
use MongoDB\Driver\Manager;


class MongoConnection implements Connection
{

    private static ?self $instance = null;

    private function __construct(string $uriConnection)
    {
        return new Manager($uriConnection);
    }
    public static function getInstance($connectionData): self
    {
        if (is_null(self::$instance)){
            self::$instance = new static(
                $connectionData['uriConnection']
            );
        }
        return self::$instance;
    }
}