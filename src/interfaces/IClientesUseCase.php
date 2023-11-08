<?php

namespace App\interfaces;

use App\entities\Clientes;

interface IClientesUseCase
{
    public function create(array $request): Clientes;
    public function update(string $id, array $request): Clientes;
    public function delete(string $id): Clientes;
    public function show(string $id): Clientes;
    public function list(): array;
    public function showByCpf(string $cpf): Clientes;

}