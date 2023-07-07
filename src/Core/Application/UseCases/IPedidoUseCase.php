<?php

namespace App\Core\Application\UseCases;

use App\Core\Domain\Entities\Pedido;

interface IPedidoUseCase
{
    public function create(array $request): Pedido;
    public function update(int $id, array $request): Pedido;
    public function delete(int $id): Pedido;
    public function show(int $id): Pedido;
    public function list(): Pedido;
    public function statusList(): array;

}