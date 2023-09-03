<?php

namespace App\interfaces;

use App\entities\Cardapio;

interface ICardapioUseCase
{
    public function create(array $request): Cardapio;
    public function update(int $id, array $request): Cardapio;
    public function delete(int $id): Cardapio;
    public function show(int $id): Cardapio;
    public function list(): array;

}