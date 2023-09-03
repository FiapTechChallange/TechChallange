<?php
namespace App\external;

use PDO;

class PdoConnect
{
    public function connect()
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
        return [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    }
}