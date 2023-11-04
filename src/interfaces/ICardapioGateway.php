<?php

namespace App\interfaces;

use App\entities\Cardapio;

interface ICardapioGateway
{
    public function create(array $data): Cardapio;
    public function update(string $id, array $data): Cardapio;
    public function delete(string $id):Cardapio;
    public function show(string $id): Cardapio;
    public function list(): array;
    public function listByCategoria(string $categoria): array;

}