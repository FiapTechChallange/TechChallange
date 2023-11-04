<?php

namespace App\api;

use App\external\base\ConnectionData;
use App\external\MongoConnection;
use App\external\MongoRedisRepository;
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
    public MongoRedisRepository $repository;

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
                    'uriConnection' => "mongodb://{$this->getMongoUsername()}:{$this->getMongoPassword()}@{$this->getMongoHost()}/{$this->getMongoDatabase()}"
                ]
            )
        );
        $this->mongoRepository->setNamespace($this->namespace, $this->getMongoDatabase());
        $this->mongoRepository->setPKey($this->pKey);

        $this->redisRepository = new RedisRepository(
            RedisConnection::getInstance(
                [
                    'host' => $this->getRedisHost(),
                    'port' => $this->getRedisPort()
                ]
            )
        );
        $this->redisRepository->setNamespace($this->namespace, $this->getRedisDatabase());
        $this->redisRepository->setPKey($this->pKey);

        $this->repository = new MongoRedisRepository($this->mongoRepository, $this->redisRepository);
    }

}