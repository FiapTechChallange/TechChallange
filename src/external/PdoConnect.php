<?php
namespace App\external;

use App\external\PdoConnection;

class PdoConnect
{
    public function __construct()
    {
        return PdoConnection::getInstance(
            $this->getDsn(),
            $this->getUsername(),
            $this->getPassword(),
            $this->getOptions()
        );
    }
    
    private function getDsn()
    {
        return $_ENV['DB_DSN'];
    }
    
    private function getUsername()
    {
        return $_ENV['DB_USERNAME'];
    }
    
    private function getPassword()
    {
        return $_ENV['DB_PASSWORD'];
    }

    private function getOptions()
    {
        return [];
    }
}