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
        $cardapio = $this->entity->show($id);
        $cardapio->categoria = (new CategoriaRepository())->show($cardapio->id_categoria);
        return $cardapio;
    }

    public function list(): Cardapio
    {
        return $this->entity->list();
    }

    public function listByCategoria(int $id_categoria)
    {
        return $this->entity->list('id_categoria', $id_categoria);
    }
}