<?php

namespace App\Core\Domain\Repositories;

use App\Core\Domain\Entities\PedidoItens;

interface IPedidoItensRepository
{
    public function create(array $data): PedidoItens;
    public function update(int $id, array $data): PedidoItens;
    public function delete(int $id):PedidoItens;
    public function show(int $id): PedidoItens;
    public function list(): PedidoItens;

}