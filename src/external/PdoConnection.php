<?php

namespace App\external;

use App\external\base\Connection;
use PDO;

class PdoConnection extends PDO implements Connection
{
    private static ?self $instance = null;

    private function __construct( $dsn, $username, $password, $options = [])
    {
        parent::__construct($dsn,$username,$password,$options);
    }

    public static function getInstance($connectionData): self
    {
        if (is_null(self::$instance)){
            self::$instance = new static(
                $connectionData['dns'],
                $connectionData['username'],
                $connectionData['password'],
                $connectionData['options']
            );
        }
        return self::$instance;
    }
}
