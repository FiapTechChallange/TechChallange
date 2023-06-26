<?php

namespace App\Adapter\Driven\Infra\Repository;

use App\Core\Domain\Entities\Pedido;
use App\Core\Domain\Repositories\IPedidoRepository;

class PedidoRepository implements IPedidoRepository
{

    protected Pedido $entity;

    public function __construct()
    {
        $this->entity = Pedido::model();
    }


    public function create(array $data): Pedido
    {
        return $this->entity->create($data);
    }

    public function update(int $id, array $data): Pedido
    {
        return $this->entity->update($id, $data);
    }

    public function delete(int $id): Pedido
    {
        return $this->entity->delete($id);
    }

    public function show(int $id): Pedido
    {
        return $this->entity->show($id);
    }

    public function list(): Pedido
    {
        return $this->entity->list();
    }
}