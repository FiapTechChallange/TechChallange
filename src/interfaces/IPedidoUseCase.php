<?php

namespace App\interfaces;

use App\entities\Pedido;

interface IPedidoUseCase
{
    public function create(array $request): Pedido;
    public function update(string $id, array $request): Pedido;
    public function delete(string $id): Pedido;
    public function show(string $id): Pedido;
    public function list(): array;
    public function statusList(): array;

}