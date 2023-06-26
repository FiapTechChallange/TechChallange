<?php

namespace App\Adapter\Driven\Infra\Repository;

use App\Core\Domain\Entities\Cardapio;
use App\Core\Domain\Repositories\ICardapioRepository;

class CardapioRepository implements ICardapioRepository
{

    protected Cardapio $entity;

    public function __construct()
    {
        $this->entity = Cardapio::model();
    }


    public function create(array $data): Cardapio
    {
        return $this->entity->create($data);
    }

    public function update(int $id, array $data): Cardapio
    {
        return $this->entity->update($id, $data);
    }

    public function delete(int $id): Cardapio
    {
        return $this->entity->delete($id);
    }

    public function show(int $id): Cardapio
    {
        return $this->entity->show($id);
    }

    public function list(): Cardapio
    {
        return $this->entity->list();
    }
}