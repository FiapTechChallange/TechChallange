<?php

namespace App\gateways;

use App\entities\Cardapio;
use App\entities\Categoria;
use App\external\PdoRepository;
use App\interfaces\ICardapioGateway;
use App\interfaces\IPdoRepository;


class CardapioGateway implements ICardapioGateway
{

    protected Cardapio $entity;
    protected String $table = 'cardapio';
    protected array $columns = [
        'id',
        'nome',
        'descricao',
        'id_categoria',
        'valor'
    ];

    protected $repository;

    protected $connection;

    public function __construct($connection, IPdoRepository $repository)
    {
        $this->repository = $repository;
        $this->repository->config($connection, $this->table, $this->columns);
        $this->entity = new Cardapio();
        $this->connection = $connection;
    }


    public function create(array $data): Cardapio
    {
        return $this->entity->fill($this->repository->create($data));
    }

    public function update(int $id, array $data): Cardapio
    {
        return $this->entity->fill($this->repository->update($id, $data));
    }

    public function delete(int $id): Cardapio
    {
        return $this->entity->fill($this->repository->delete($id));
    }

    public function show(int $id): Cardapio
    {
        $cardapio = $this->repository->show($id);
        $categoria = (new CategoriaGateway($this->connection, $this->repository))->show($cardapio['id_categoria']);
        $cardapio['categoria'] = $categoria['nome'];
        return $this->entity->fill($cardapio);
    }

    public function list(): array
    {
        $response = [];
        foreach($this->repository->list() as $row){
            $response[] = $this->entity->fill($row);
        }

        return $response;
    }

    public function listByCategoria(int $id_categoria)
    {
        return $this->repository->list('id_categoria', $id_categoria);
    }
}