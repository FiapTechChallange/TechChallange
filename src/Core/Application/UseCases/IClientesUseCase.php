<?php

namespace App\Core\Application\UseCases;

use App\Core\Domain\Entities\Clientes;

interface IClientesUseCase
{
    public function create(array $request): Clientes;
    public function update(int $id, array $request): Clientes;
    public function delete(int $id): Clientes;
    public function show(int $id): Clientes;
    public function list(): Clientes;

    public function showByCpf(string $cpf): Clientes;

}