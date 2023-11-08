<?php

namespace App\external;

use App\external\base\Connection;
use MongoDB\Driver\Manager;


class MongoConnection implements Connection
{

    private static ?self $instance = null;

    public Manager $manager;

    private function __construct(string $uriConnection)
    {
        $this->manager = new Manager($uriConnection);
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