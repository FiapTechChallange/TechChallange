<?php

namespace App\interfaces;

use App\entities\PedidoItens;

interface IPedidoItensGateway
{
    public function create(array $data): PedidoItens;
    public function update(int $id, array $data): PedidoItens;
    public function delete(int $id):PedidoItens;
    public function show(int $id): PedidoItens;
    public function list(): array;

}