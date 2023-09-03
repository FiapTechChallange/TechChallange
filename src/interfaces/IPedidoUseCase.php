<?php

namespace App\interfaces;

use App\entities\Pedido;

interface IPedidoUseCase
{
    public function create(array $request): Pedido;
    public function update(int $id, array $request): Pedido;
    public function delete(int $id): Pedido;
    public function show(int $id): Pedido;
    public function list(): array;
    public function statusList(): array;

}