<?php

namespace App\Core\Application\UseCases;

use App\Core\Domain\Entities\Preparo;

interface IPreparoUseCase
{
    public function create(array $request): Preparo;
    public function update(int $id, array $request): Preparo;
    public function delete(int $id): Preparo;
    public function show(int $id): Preparo;
    public function list(): Preparo;

}