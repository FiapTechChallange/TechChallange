<?php

namespace App\interfaces;

use App\entities\Clientes;

interface IClientesUseCase
{
    public function create(array $request): Clientes;
    public function update(int $id, array $request): Clientes;
    public function delete(int $id): Clientes;
    public function show(int $id): Clientes;
    public function list(): array;

    public function showByCpf(string $cpf): array;

}