<?php

namespace App\usecases;

use App\entities\PedidoItens;
use App\interfaces\IPedidoItensGateway;
use App\interfaces\IPedidoItensUseCase;

class PedidoItensUseCase implements IPedidoItensUseCase
{

    protected $gateway;

    public function __construct(IPedidoItensGateway $gateway)
    {
        $this->gateway = $gateway;
    }


    public function create(array $request): PedidoItens
    {
        return $this->gateway->create($request);
    }

    public function update(int $id, array $request): PedidoItens
    {
        return $this->gateway->update($id, $request);
    }

    public function delete(int $id): PedidoItens
    {
        return $this->gateway->delete($id);
    }

    public function show(int $id): PedidoItens
    {
        return $this->gateway->show($id);
    }

    public function list(): array
    {
        return $this->gateway->list()['itens'];
    }
}