<?php

namespace App\gateways;

use App\types\EnumStatus;
use App\entities\Preparo;
use App\interfaces\IPdoRepository;
use App\interfaces\IPreparoGateway;

class PreparoGateway implements IPreparoGateway
{

    protected Preparo $entity;

    protected String $table = 'preparo';
    protected array $columns = [
        'id',
        'id_pedido',
        'inicio',
        'termino'
    ];

    protected $repository;

    protected $connection;

    public function __construct($connection, IPdoRepository $repository)
    {
        $this->repository = $repository;
        $this->repository->config($connection, $this->table, $this->columns);
        $this->entity = new Preparo();
        $this->connection = $connection;
    }


    public function create(array $data): Preparo
    {
        $response = $this->repository->create($data);
        (new PedidoGateway($this->connection, $this->repository))->update($data['id_pedido'], ['status' => EnumStatus::EM_PREPARACAO]);

        return $this->entity->fill($response);
    }

    public function update(int $id, array $data): Preparo
    {
        $response = $this->repository->update($id, $data);
        if(!empty($data['termino'])){
            (new PedidoGateway($this->connection, $this->repository))->update($data['id_pedido'], ['status' => EnumStatus::PRONTO]);
        }
        return $this->entity->fill($response);
    }

    public function delete(int $id): Preparo
    {
        return $this->entity->fill($this->repository->delete($id));
    }

    public function show(int $id): Preparo
    {
        return $this->entity->fill($this->repository->show($id));
    }

    public function list(): array
    {
        $response = [];
        foreach($this->repository->list() as $row){
            $response[] = (new Preparo())->fill($row);
        }

        return $response;
    }
}