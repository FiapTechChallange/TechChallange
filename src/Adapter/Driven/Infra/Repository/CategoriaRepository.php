<?php

namespace App\Adapter\Driven\Infra\Repository;

use App\Core\Domain\Entities\Cardapio;
use App\Core\Domain\Entities\Categoria;
use App\Core\Domain\Repositories\ICardapioRepository;
use App\Core\Domain\Repositories\ICategoriaRepository;

class CategoriaRepository implements ICategoriaRepository
{

    protected Categoria $entity;

    public function __construct()
    {
        $this->entity = Categoria::model();
    }


    public function create(array $data): Categoria
    {
        return $this->entity->create($data);
    }

    public function update(int $id, array $data): Categoria
    {
        return $this->entity->update($id, $data);
    }

    public function delete(int $id): Categoria
    {
        return $this->entity->delete($id);
    }

    public function show(int $id): Categoria
    {
        $categoria = $this->entity->show($id);
        $itensCardapio = (new CardapioRepository())->listByCategoria($id);
        if(!empty($itensCardapio->collection)) {
            $categoria->itensCardapio = $itensCardapio->collection;
        }
        return $categoria;
    }

    public function list(): Categoria
    {
        $categorias = $this->entity->list();

        $collection = [];
        $total = 0;
        foreach($categorias->collection as $item){
            $itemCollection = $item;
            $itensCardapio = (new CardapioRepository())->listByCategoria($item['id']);
            if(!empty($itensCardapio->collection)) {
                $itemCollection['itens_cardapio'] = $itensCardapio->collection;
            }
            $collection[] = $itemCollection;
        }
        $categorias->collection = $collection;
        return $categorias;
    }
}