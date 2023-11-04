<?php

namespace App\interfaces;

use App\entities\Clientes;

interface IClientesGateway
{
    public function create(array $data): Clientes;
    public function update(string $id, array $data): Clientes;
    public function delete(string $id):Clientes;
    public function show(string $id): Clientes;
    public function list(): array;

}