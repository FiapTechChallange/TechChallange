<?php

namespace App\external;

use PDO;

class PdoConnection extends PDO
{
    private static ?self $instance = null;

    private function __construct( $dsn, $username, $password, $options = [])
    {
        parent::__construct($dsn,$username,$password,$options);
    }

    public static function getInstance($dsn, $username, $password, $options = []): self
    {
        if (is_null(self::$instance)){
            self::$instance = new static($dsn, $username, $password, $options);
        }

        return self::$instance;
    }
}
