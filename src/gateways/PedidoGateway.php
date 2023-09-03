<?php

namespace App\gateways;

use App\types\EnumStatus;
use App\entities\Pedido;
use App\interfaces\IPdoRepository;
use App\interfaces\IPedidoGateway;

class PedidoGateway implements IPedidoGateway
{

    protected Pedido $entity;

    protected String $table = 'pedido';
    protected array $columns = [
        'id',
        'id_cliente',
        'fechamento',
        'pagamento',
        'status'
    ];

    protected $repository;

    protected $connection;

    public function __construct($connection, IPdoRepository $repository)
    {
        $this->repository = $repository;
        $this->repository->config($connection, $this->table, $this->columns);
        $this->entity = new Pedido();
        $this->connection = $connection;
    }


    public function create(array $data): Pedido
    {
        if(isset($data['status'])){
            if(!array_key_exists($data['status'], EnumStatus::getList())){
                if(!in_array($data['status'], EnumStatus::getList())){
                    throw new \Exception("Status inválido");
                } else {
                    $data['status'] = array_search($data['status'] ,EnumStatus::getList());
                }
            }
        }

        return $this->entity->fill($this->repository->create($data));
    }

    public function update(int $id, array $data): Pedido
    {
        if(isset($data['status'])){
            if(!array_key_exists($data['status'], EnumStatus::getList())){
                if(!in_array($data['status'], EnumStatus::getList())){
                    throw new \Exception("Status inválido");
                } else {
                    $data['status'] = array_search($data['status'] ,EnumStatus::getList());
                }
            }
        }

        return $this->entity->fill($this->repository->update($id, $data));
    }

    public function delete(int $id): Pedido
    {
        return $this->entity->fill($this->repository->delete($id));
    }

    public function show(int $id): Pedido
    {
        $pedido = $this->repository->show($id);
        $pedido['itens'] = (new PedidoItensGateway($this->connection, $this->repository))->list('id_pedido', $pedido->id);
        $pedido['cliente'] = $pedido->id_cliente?(new ClientesGateway($this->connection, $this->repository))->show($pedido->id_cliente):null;
        $pedido['preparo'] = (new PreparoGateway($this->connection, $this->repository))->list('id_pedido', $pedido->id);

        return $this->entity->fill($pedido);
    }

    public function list(): array
    {
        $response = [];
        foreach($this->repository->list() as $row){
            $response[] = $this->entity->fill($row);
        }

        return $response;
    }
}