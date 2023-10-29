<?php

namespace App\gateways;

use App\entities\Categoria;
use App\external\base\IRepository;
use App\interfaces\ICategoriaGateway;

class CategoriaGateway implements ICategoriaGateway
{

    protected Categoria $entity;

    protected String $table = 'categoria';
    protected array $columns = [
        'id',
        'nome'
    ];
    protected $repository;

    protected $connection;

    public function __construct($connection, IRepository $repository)
    {
        $this->repository = $repository;
        $this->repository->config($connection, $this->table, $this->columns);
        $this->entity = new Categoria();
        $this->connection = $connection;
    }


    public function create(array $data): Categoria
    {
        return $this->entity->fill($this->repository->create($data));
    }

    public function update(int $id, array $data): Categoria
    {
        return $this->entity->fill($this->repository->update($id, $data));
    }

    public function delete(int $id): Categoria
    {
        return $this->entity->fill($this->repository->delete($id));
    }

    public function show(int $id): Categoria
    {
        $categoria = $this->repository->show($id);
        if(!empty($categoria)) {
            $itensCardapio = (new CardapioGateway($this->connection, $this->repository))->listByCategoria($id);
            if (!empty($itensCardapio)) {
                $categoria['itensCardapio'] = $itensCardapio;
            }
        }
        return $this->entity->fill($categoria);
    }

    public function list(): array
    {
        $categorias = $this->repository->list();

        $collection = [];
        $total = 0;
        foreach($categorias as $item){
            $row = $item;
            $itensCardapio = (new CardapioGateway($this->connection, $this->repository))->listByCategoria($item['id']);
            if(!empty($itensCardapio)) {
                $row['itens_cardapio'] = $itensCardapio;
            }
            $collection[] = (new Categoria())->fill($row);
        }
        return $collection;
    }
}