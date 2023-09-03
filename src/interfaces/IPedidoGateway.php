<?php

namespace App\interfaces;

use App\entities\Pedido;

interface IPedidoGateway
{
    public function create(array $data): Pedido;
    public function update(int $id, array $data): Pedido;
    public function delete(int $id):Pedido;
    public function show(int $id): Pedido;
    public function list(): array;

}