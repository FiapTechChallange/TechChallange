<?php

namespace App\interfaces;

use App\entities\Cardapio;

interface ICardapioGateway
{
    public function create(array $data): Cardapio;
    public function update(int $id, array $data): Cardapio;
    public function delete(int $id):Cardapio;
    public function show(int $id): Cardapio;
    public function list(): array;

}