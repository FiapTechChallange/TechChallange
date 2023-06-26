<?php

namespace App\Core\Domain\Repositories;

use App\Core\Domain\Entities\Cardapio;

interface ICardapioRepository
{
    public function create(array $data): Cardapio;
    public function update(int $id, array $data): Cardapio;
    public function delete(int $id):Cardapio;
    public function show(int $id): Cardapio;
    public function list(): Cardapio;

}