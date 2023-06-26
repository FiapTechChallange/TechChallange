<?php

namespace App\Adapter\Driven\Infra\Repository;

use App\Core\Domain\Entities\Preparo;
use App\Core\Domain\Repositories\IPreparoRepository;

class PreparoRepository implements IPreparoRepository
{

    protected Preparo $entity;

    public function __construct()
    {
        $this->entity = Preparo::model();
    }


    public function create(array $data): Preparo
    {
        return $this->entity->create($data);
    }

    public function update(int $id, array $data): Preparo
    {
        return $this->entity->update($id, $data);
    }

    public function delete(int $id): Preparo
    {
        return $this->entity->delete($id);
    }

    public function show(int $id): Preparo
    {
        return $this->entity->show($id);
    }

    public function list(): Preparo
    {
        return $this->entity->list();
    }
}