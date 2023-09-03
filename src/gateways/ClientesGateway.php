<?php

namespace App\gateways;

use App\entities\Clientes;
use App\interfaces\IClientesGateway;
use App\interfaces\IPdoRepository;

class ClientesGateway implements IClientesGateway
{

    protected Clientes $entity;

    protected String $table = 'clientes';
    protected array $columns = [
        'cpf',
        'nome',
        'email',
        'telefone'
    ];

    protected $repository;

    protected $connection;

    public function __construct($connection, IPdoRepository $repository)
    {
        $this->repository = $repository;
        $this->repository->config($connection, $this->table, $this->columns);
        $this->entity = new Clientes();
        $this->connection = $connection;
    }


    public function create(array $data): Clientes
    {
        return $this->entity->fill($this->repository->create($data));
    }

    public function update(int $id, array $data): Clientes
    {
        return $this->entity->fill($this->repository->update($id, $data));
    }

    public function delete(int $id): Clientes
    {
        return $this->entity->fill($this->repository->delete($id));
    }

    public function show(int $id): Clientes
    {
        return $this->entity->fill($this->repository->show($id));
    }

    public function list($column = null, $value = null): array
    {
        $response = [];
        foreach($this->repository->list($column, $value) as $row){
            $response[] = (new Clientes())->fill($row);
        }
        return $response;
    }
}