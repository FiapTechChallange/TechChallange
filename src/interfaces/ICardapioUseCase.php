<?php

namespace App\interfaces;

use App\entities\Cardapio;

interface ICardapioUseCase
{
    public function create(array $request): Cardapio;
    public function update(string $id, array $request): Cardapio;
    public function delete(string $id): Cardapio;
    public function show(string $id): Cardapio;
    public function list(): array;
    public function categoriasList(): array;
    public function listByCategoria(string $categoria): array;


}