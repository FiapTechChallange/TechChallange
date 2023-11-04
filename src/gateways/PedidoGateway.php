<?php

namespace App\gateways;

use App\api\DBGateway;
use App\entities\Pedido;
use App\interfaces\IPedidoGateway;
use App\types\EnumStatus;

class PedidoGateway extends DBGateway implements IPedidoGateway
{
    protected Pedido $entity;

    protected string $namespace = 'pedido';

    protected string $pKey = '_id';
    protected array $fields = [
        'id',
        'cpf_cliente',
        'recebimento',
        'fechamento',
        'pagamento',
        'status',
        'itens',
        'inicio_preparo',
        'fim_preparo',
        'total_pedido',
        'checkout'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->entity = new Pedido();
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

    public function update(string $id, array $data): Pedido
    {
        if(isset($data['checkout']['status'])){

        }

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

    public function delete(string $id): Pedido
    {
        return $this->entity->fill($this->repository->delete($id));
    }

    public function show(string $id): Pedido
    {
        $pedido = $this->repository->show($id);
        if(!empty($pedido)) {
            $pedido = $this->completeData($pedido);
        }

        return $this->entity->fill($pedido);
    }

    private function completeData($pedido):array
    {
        $pedido['cliente'] = $pedido['cpf_cliente'] ? (new ClientesGateway())->show($pedido['cpf_cliente']) : null;
        $itensPedido = array_combine(array_column($pedido['itens'], '_id'), array_column($pedido['itens'], 'qtde'));
        $itensCardapio = (new CardapioGateway())->listByIdItems(array_keys($pedido['itens']));
        $pedido['total_pedido'] = 0;
        foreach ($itensCardapio as $itemCardapio){
            $pedido['total_pedido'] += ($itemCardapio['total'] * $itensPedido[$itemCardapio['_id']]);
        }
    }

    public function list(): array
    {
        $response = [];
        foreach($this->repository->list() as $row){
            $response[] = (new Pedido())->fill($this->completeData($row));
        }

        return $response;
    }

    public function pedidos(): array
    {
        $pedidos = $this->mongoRepository->query(
            [
                'status' => [
                    '$in' => [EnumStatus::PRONTO->name, EnumStatus::EM_PREPARACAO->name, EnumStatus::RECEBIDO->name]
                ]
            ]
        );

        $response = [];
        foreach($pedidos as $i => $pedido){
            $response[$i][] = (new Pedido())->fill($this->completeData($pedido));
        }
        return $response;

    }

    public function listByStatus($status)
    {
        $pedidos = $this->mongoRepository->query(
            [
                'status' => [
                    '$eq' => strtoupper($status)
                ]
            ]
        );

        $response = [];
        foreach($pedidos as $i => $pedido){
            $response[$i][] = (new Pedido())->fill($this->completeData($pedido));
        }
        return $response;
    }
}