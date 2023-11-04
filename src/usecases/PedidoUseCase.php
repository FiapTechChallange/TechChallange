<?php

namespace App\usecases;

use App\entities\Pedido;
use App\interfaces\IPedidoGateway;
use App\interfaces\IPedidoUseCase;
use App\types\EnumStatus;

class PedidoUseCase implements IPedidoUseCase
{

    protected $gateway;

    public function __construct(IPedidoGateway $gateway)
    {
        $this->gateway = $gateway;
    }


    public function create(array $request): Pedido
    {
        return $this->gateway->create($request);
    }

    public function update(string $id, array $request): Pedido
    {
        return $this->gateway->update($id, $request);
    }

    public function delete(string $id): Pedido
    {
        return $this->gateway->delete($id);
    }

    public function show(string $id): Pedido
    {
        return $this->gateway->show($id);
    }

    public function list(): array
    {
        return $this->gateway->list();
    }

    public function statusList(): array
    {
        return EnumStatus::getList();
    }

    public function pedidos(): array
    {
        return $this->gateway->pedidos();
    }

    public function listByStatus(string $status): array
    {
        $this->gateway->listByStatus($status);
    }
}