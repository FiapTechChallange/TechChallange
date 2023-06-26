<?php

namespace App\Core\Domain\Repositories;

use App\Core\Domain\Entities\Preparo;

interface IPreparoRepository
{
    public function create(array $data): Preparo;
    public function update(int $id, array $data): Preparo;
    public function delete(int $id):Preparo;
    public function show(int $id): Preparo;
    public function list(): Preparo;

}