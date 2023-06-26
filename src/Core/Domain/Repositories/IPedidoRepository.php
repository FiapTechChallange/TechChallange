<?php

namespace App\Core\Domain\Repositories;

use App\Core\Domain\Entities\Pedido;

interface IPedidoRepository
{
    public function create(array $data): Pedido;
    public function update(int $id, array $data): Pedido;
    public function delete(int $id):Pedido;
    public function show(int $id): Pedido;
    public function list(): Pedido;

}