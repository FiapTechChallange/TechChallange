<?php

namespace App\Adapter\Driven\Infra\Repository;

use App\Core\Domain\Entities\Pedido;
use App\Core\Domain\Entities\PedidoItens;
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
        $pedido = $this->entity->show($id);
        $pedido->itens = (new PedidoItensRepository())->list('id_pedido', $pedido->id);
        $pedido->cliente = $pedido->id_cliente?(new ClientesRepository())->show($pedido->id_cliente):null;
        $pedido->preparo = (new PreparoRepository())->list('id_pedido', $pedido->id);

        return $pedido;
    }

    public function list(): Pedido
    {
        return $this->entity->list();
    }
}