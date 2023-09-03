<?php

namespace App\gateways;

use App\entities\PedidoItens;
use App\interfaces\IPdoRepository;
use App\interfaces\IPedidoItensGateway;

class PedidoItensGateway implements IPedidoItensGateway
{

    protected PedidoItens $entity;

    protected String $table = 'pedido_itens';
    protected array $columns = [
        'id',
        'id_pedido',
        'id_item_cardapio',
        'observacoes'
    ];

    protected $repository;

    protected $connection;

    public function __construct($connection, IPdoRepository $repository)
    {
        $this->repository = $repository;
        $this->repository->config($connection, $this->table, $this->columns);
        $this->entity = new PedidoItens();
        $this->connection = $connection;
    }


    public function create(array $data): PedidoItens
    {
        return $this->entity->fill($this->repository->create($data));
    }

    public function update(int $id, array $data): PedidoItens
    {
        return $this->entity->fill($this->repository->update($id, $data));
    }

    public function delete(int $id): PedidoItens
    {
        return $this->entity->fill($this->repository->delete($id));
    }

    public function show(int $id): PedidoItens
    {
        return $this->entity->fill($this->repository->show($id));
    }

    public function list(): array
    {
        $pedidoItens = $this->repository->list();

        $collection = [];
        $total = 0;
        foreach($pedidoItens as $item){
            $itemCollection = $item;
            $cardapio = (new CardapioGateway($this->connection, $this->repository))->show($item['id_item_cardapio']);
            $itemCollection['item_cardapio'] = [
                'id' => $cardapio['id'],
                'nome' => $cardapio['nome'],
                'descricao' => $cardapio['descricao'],
                'categoria' => $cardapio['categoria'],
                'valor' => $cardapio['valor']
            ];
            $collection[] = (new PedidoItens())->fill($itemCollection);
            $total += $cardapio->valor;
        }

        return $collection;
    }
}