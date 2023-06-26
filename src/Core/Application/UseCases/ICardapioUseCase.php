<?php

namespace App\Core\Application\UseCases;

use App\Core\Domain\Entities\Cardapio;

interface ICardapioUseCase
{
    public function create(array $request): Cardapio;
    public function update(int $id, array $request): Cardapio;
    public function delete(int $id): Cardapio;
    public function show(int $id): Cardapio;
    public function list(): Cardapio;

}