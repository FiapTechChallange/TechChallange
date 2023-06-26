<?php
namespace App\Adapter\Driven\Infra\Connection;


trait Connect
{
    public function connect():Connection
    {
        return Connection::getInstance(
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