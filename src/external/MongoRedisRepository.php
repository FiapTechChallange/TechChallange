<?php

namespace App\external;

class MongoRedisRepository
{
   protected MongoRepository $mongoRepository;
   protected RedisRepository $redisRepository;

    /**
     * @param MongoRepository $mongoRepository
     * @param RedisRepository $redisRepository
     */
    public function __construct(MongoRepository $mongoRepository, RedisRepository $redisRepository)
    {
        $this->mongoRepository = $mongoRepository;
        $this->redisRepository = $redisRepository;
    }

    public function create(array $data)
    {
        $r = $this->mongoRepository->create($data);
        if($r == 1){
            $data['oid'] = $this->mongoRepository->getLastInsertId();
            $r = $this->redisRepository->create($data);
        }
        return $this->redisRepository->show($data[$this->redisRepository->getPKey()]);
    }

    public function update(string $id, array $data, $pKey = null, $expToUpdate = [])
    {
        if(!array_key_exists($this->redisRepository->getPKey(), $data)){
            $data[$this->redisRepository->getPKey()] = $id;
        }

        $this->mongoRepository->update($id, $data, $pKey, $expToUpdate);
        $this->redisRepository->update($id, $data);

        return $this->redisRepository->show($id);
    }

    public function delete(string $id)
    {
        $this->mongoRepository->delete($id);
        $r = $this->redisRepository->delete($id);
        return $r;
    }

    public function show(string $id)
    {
        $r = $this->redisRepository->show($id);
        if(empty($r)){
            $r = $this->mongoRepository->show($id);
            if(!empty($r)){
                $this->redisRepository->create($r);
            }
        }
        return $r;
    }

    public function list()
    {
        $r = $this->redisRepository->list();
        if(empty($r)){
            $r = $this->mongoRepository->list();
            if(!empty($r)){
                foreach($r as $item){
                    $this->redisRepository->create((array)$item);
                }
            }
        }
        return $r;
    }

}