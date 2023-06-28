<?php

namespace App\Core\Domain\Repositories;

use App\Core\Domain\Entities\Categoria;

interface ICategoriaRepository
{
    public function create(array $data): Categoria;
    public function update(int $id, array $data): Categoria;
    public function delete(int $id):Categoria;
    public function show(int $id): Categoria;
    public function list(): Categoria;

}