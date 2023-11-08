<?php

namespace App\interfaces;

use App\entities\Pedido;

interface IPedidoGateway
{
    public function create(array $data): Pedido;
    public function update(string $id, array $data): Pedido;
    public function delete(string $id):Pedido;
    public function show(string $id): Pedido;
    public function list(): array;

}