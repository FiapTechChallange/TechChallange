<?php

namespace App\gateways;

use App\api\DBGateway;
use App\entities\Clientes;
use App\interfaces\IClientesGateway;

class ClientesGateway extends DBGateway implements IClientesGateway
{

    protected Clientes $entity;


    protected string $namespace = 'clientes';

    protected string $pKey = 'cpf';
    protected array $fields = [
        'cpf',
        'nome',
        'email',
        'telefone'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->entity = new Clientes();
    }


    public function create(array $data): Clientes
    {
        return $this->entity->fill($this->repository->create($data));
    }

    public function update(string $id, array $data): Clientes
    {
        return $this->entity->fill($this->repository->update($id, $data));
    }

    public function delete(string $id): Clientes
    {
        return $this->entity->fill($this->repository->delete($id));
    }

    public function show(string $id): Clientes
    {
        return $this->entity->fill($this->repository->show($id));
    }

    public function list(): array
    {
        $response = [];
        foreach($this->repository->list() as $row){
            $response[] = (new Clientes())->fill($row);
        }
        return $response;
    }
}