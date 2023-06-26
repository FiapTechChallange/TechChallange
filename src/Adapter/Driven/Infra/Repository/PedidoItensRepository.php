<?php

namespace App\Adapter\Driven\Infra\Repository;

use App\Core\Domain\Entities\PedidoItens;
use App\Core\Domain\Repositories\IPedidoItensRepository;
class PedidoItensRepository implements IPedidoItensRepository
{

    protected PedidoItens $entity;

    public function __construct()
    {
        $this->entity = PedidoItens::model();
    }


    public function create(array $data): PedidoItens
    {
        return $this->entity->create($data);
    }

    public function update(int $id, array $data): PedidoItens
    {
        return $this->entity->update($id, $data);
    }

    public function delete(int $id): PedidoItens
    {
        return $this->entity->delete($id);
    }

    public function show(int $id): PedidoItens
    {
        return $this->entity->show($id);
    }

    public function list(): PedidoItens
    {
        $pedidoItens = $this->entity->list();

        $collection = [];
        $total = 0;
        foreach($pedidoItens->collection as $item){
            $itemCollection = $item;
            $cardapio = (new CardapioRepository())->show($item['id_item_cardapio']);
            $itemCollection['item_cardapio'] = [
                'id' => $cardapio->id,
                'nome' => $cardapio->nome,
                'descricao' => $cardapio->descricao,
                'categoria' => $cardapio->categoria,
                'valor' => $cardapio->valor
            ];
            $collection[] = $itemCollection;
            $total += $cardapio->valor;
        }
        $pedidoItens->collection = $collection;
        $pedidoItens->total = $total;

        return $pedidoItens;
    }
}