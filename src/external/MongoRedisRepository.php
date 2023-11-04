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
            $data['_id'] = $this->mongoRepository->getLastInsertId();
            $r = $this->redisRepository->create($data);
        }
        return $r;
    }

    public function update(string $id, array $data)
    {
        $r = $this->mongoRepository->update($id, $data);
        if($r == 1){
            $r = $this->redisRepository->update($id, $data);
        }
        return $r;
    }

    public function delete(string $id)
    {
        $r = $this->mongoRepository->delete($id);
        if($r == 1){
            $r = $this->redisRepository->delete($id);
        }
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
                    $this->redisRepository->create($item);
                }
            }
        }
        return $r;
    }

}