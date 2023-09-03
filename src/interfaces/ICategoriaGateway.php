<?php

namespace App\interfaces;

use App\entities\Categoria;

interface ICategoriaGateway
{
    public function create(array $data): Categoria;
    public function update(int $id, array $data): Categoria;
    public function delete(int $id):Categoria;
    public function show(int $id): Categoria;
    public function list(): array;

}