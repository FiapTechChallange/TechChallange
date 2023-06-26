<?php

namespace App\Core\Domain\Repositories;

use App\Core\Domain\Entities\Clientes;

interface IClientesRepository
{
    public function create(array $data): Clientes;
    public function update(int $id, array $data): Clientes;
    public function delete(int $id):Clientes;
    public function show(int $id): Clientes;
    public function list(): Clientes;

}