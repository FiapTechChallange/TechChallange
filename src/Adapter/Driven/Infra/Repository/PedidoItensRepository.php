<?php

namespace App\Adapter\Driven\Infra\Repository;

use App\Core\Domain\Entities\PedidoItens;
use App\Core\Domain\Repositories\IPedidoItensRepository;
class PedidoItensRepository implements IPedidoItensRepository
{

    protected PedidoItens $entity;

    public function __construct()
    {
        $this->entity = PedidoItens::model();
    }


    public function create(array $data): PedidoItens
    {
        return $this->entity->create($data);
    }

    public function update(int $id, array $data): PedidoItens
    {
        return $this->entity->update($id, $data);
    }

    public function delete(int $id): PedidoItens
    {
        return $this->entity->delete($id);
    }

    public function show(int $id): PedidoItens
    {
        return $this->entity->show($id);
    }

    public function list(): PedidoItens
    {
        return $this->entity->list();
    }
}