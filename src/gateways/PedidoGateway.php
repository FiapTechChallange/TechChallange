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
        'recebimento',
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
            $status = $data['status'] instanceof \UnitEnum?$data['status']->name:$data['status'];
            if(!array_key_exists($status, EnumStatus::getList())){
                throw new \Exception("Status inválido");
            } else {
                $data['status'] = $status;
            }
        }

        return $this->entity->fill($this->repository->create($data));
    }

    public function update(int $id, array $data): Pedido
    {
        if(isset($data['status'])){
            $status = $data['status'] instanceof \UnitEnum?$data['status']->name:$data['status'];
            if(!array_key_exists($status, EnumStatus::getList())){
                    throw new \Exception("Status inválido");
            } else {
                    $data['status'] = $status;
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
        if(!empty($pedido)) {
            $pedido['itens'] = (new PedidoItensGateway($this->connection, $this->repository))->list('id_pedido', $pedido['id']);
            $pedido['cliente'] = $pedido['id_cliente'] ? (new ClientesGateway($this->connection, $this->repository))->show($pedido['id_cliente']) : null;
            $pedido['preparo'] = (new PreparoGateway($this->connection, $this->repository))->list('id_pedido', $pedido['id']);
        }

        return $this->entity->fill($pedido);
    }

    public function list(): array
    {
        $response = [];
        foreach($this->repository->list() as $row){
            $response[] = (new Pedido())->fill($row);
        }

        return $response;
    }

    public function pedidos(): array
    {
        $status = "'" . implode("','",[EnumStatus::PRONTO->name, EnumStatus::EM_PREPARACAO->name, EnumStatus::RECEBIDO->name]). "'";
        $sql = "SELECT * FROM pedido WHERE status IN({$status}) ";
        $sql .= "ORDER BY FIELD(status,{$status}), recebimento ";
        $pedidos = [];
        foreach($this->repository->queryAll($sql) as $i => $pedido){
            $pedidoItems = (new PedidoItensGateway($this->connection, $this->repository))->list('id_pedido', $pedido['id']);
            $pedidos[$i] = $pedido;
            $pedidos[$i]['itens'] = $pedidoItems['itens'];
            $pedidos[$i]['total'] = $pedidoItems['total'];
        }
        return $pedidos;

    }
}