<?php

namespace App\Core\Application\UseCases;

use App\Core\Domain\Entities\Categoria;

interface ICategoriaUseCase
{
    public function create(array $request): Categoria;
    public function update(int $id, array $request): Categoria;
    public function delete(int $id): Categoria;
    public function show(int $id): Categoria;
    public function list(): Categoria;

}