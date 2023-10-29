<?php

namespace App\api;

use App\external\base\ConnectionData;
use App\external\MongoConnection;
use App\external\MongoRepository;
use App\external\PdoConnection;
use App\external\PdoRepository;
use App\external\RedisConnection;
use App\external\RedisRepository;

abstract class DBGateway extends ConnectionData
{
    public PdoRepository $pdoRepository;
    public MongoRepository $mongoRepository;
    public RedisRepository $redisRepository;

    public function __construct()
    {
        $this->pdoRepository = new PdoRepository(
            PdoConnection::getInstance(
                [
                    'dns' => $this->getDsn(),
                    'username' => $this->getPdoUsername(),
                    'password' =>  $this->getPdoPassword(),
                    'options' =>  $this->getPdoOptions()
                ]
            )
        );

        $this->mongoRepository = new MongoRepository(
            MongoConnection::getInstance(
                [
                    'uriConnection' => "mongodb://{$this->getMongoHost()}/{$this->getMongoDatabase()}"
                ]
            )
        );

        $this->redisRepository = new RedisRepository(
            RedisConnection::getInstance(
                [
                    'uriConnection' => ''
                ]
            )
        );
    }

}