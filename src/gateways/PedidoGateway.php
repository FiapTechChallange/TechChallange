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

    protected string $pKey = 'oid';
    protected array $fields = [
        'oid',
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
        if(isset($data['status'])){
            $status = $data['status'] instanceof \UnitEnum?$data['status']->name:$data['status'];
            if(!array_key_exists($status, EnumStatus::getList())){
                    throw new \Exception("Status inválido");
            } else {
                    $data['status'] = $status;
            }
        }

        $query = $this->mongoRepository->show($id);
        $expToUpdate = [];
        if (isset($data['itens']) && isset($query['itens'])) {
            $expToUpdate = [
                '$unset' => ['itens' => ""]
            ];
            $this->repository->update($id, $data, null, $expToUpdate);
        }

        return $this->entity->fill($this->repository->update($id, $data));
    }

    public function delete(string $id): Pedido
    {
        return $this->entity->fill($this->repository->delete($id));
    }

    public function show(string $id): Pedido
    {
        $pedido = $this->mongoRepository->show($id);
        if(!empty($pedido)) {
            $pedido = $this->completeData($pedido);
        }

        return $this->entity->fill($pedido);
    }

    private function completeData($pedido):array
    {
        $pedido = (array)$pedido;
        $pedido['cliente'] = isset($pedido['cpf_cliente']) ? (new ClientesGateway())->show($pedido['cpf_cliente']) : null;

        if(isset($pedido['itens'])) {
            $itensPedido = array_combine(array_column($pedido['itens'], '_id'), array_column($pedido['itens'], 'qtde'));
            $itensCardapio = (new CardapioGateway())->listByIdItems(array_keys($itensPedido));

            $pedido['total_pedido'] = 0;
            $itens = [];
            foreach ($pedido['itens'] as $i => $item) {
                if (isset($itensCardapio[$item->{'_id'}])) {
                    $itens[$i] = $itensCardapio[$item->{'_id'}];
                }
                if (isset($itens[$i]['valor']) && isset($itens[$i]['oid'])) {
                    $pedido['total_pedido'] += ($itens[$i]['valor'] * $itensPedido[$itens[$i]['oid']]);
                }
            }
            unset($pedido['itens']);
            $pedido['itens'] = $itens;
        }

        return $pedido;
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
                    '$in' => [EnumStatus::FINALIZADO->name, EnumStatus::EM_PREPARACAO->name, EnumStatus::RECEBIDO->name]
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