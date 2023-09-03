<?php

namespace App\interfaces;

use App\entities\PedidoItens;

interface IPedidoItensUseCase
{
    public function create(array $request): PedidoItens;
    public function update(int $id, array $request): PedidoItens;
    public function delete(int $id): PedidoItens;
    public function show(int $id): PedidoItens;
    public function list(): array;

}