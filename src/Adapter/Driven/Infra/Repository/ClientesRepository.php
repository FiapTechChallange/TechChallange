<?php

namespace App\Adapter\Driven\Infra\Repository;

use App\Core\Domain\Entities\Clientes;
use App\Core\Domain\Repositories\IClientesRepository;

class ClientesRepository implements IClientesRepository
{

    protected Clientes $entity;

    /**
     * @param Clientes $entity
     */
    public function __construct()
    {
        $this->entity = Clientes::model();
    }


    public function create(array $data): Clientes
    {
        return $this->entity->create($data);
    }

    public function update(int $id, array $data): Clientes
    {
        return $this->entity->update($id, $data);
    }

    public function delete(int $id): Clientes
    {
        return $this->entity->delete($id);
    }

    public function show(int $id): Clientes
    {
        return $this->entity->show($id);
    }

    public function list(): Clientes
    {
        return $this->entity->list();
    }
}