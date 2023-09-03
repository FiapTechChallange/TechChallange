<?php

namespace App\interfaces;

use App\entities\Preparo;

interface IPreparoGateway
{
    public function create(array $data): Preparo;
    public function update(int $id, array $data): Preparo;
    public function delete(int $id):Preparo;
    public function show(int $id): Preparo;
    public function list(): array;

}