<?php

namespace App\interfaces;

use App\entities\Clientes;

interface IClientesGateway
{
    public function create(array $data): Clientes;
    public function update(int $id, array $data): Clientes;
    public function delete(int $id):Clientes;
    public function show(int $id): Clientes;
    public function list(): array;

}