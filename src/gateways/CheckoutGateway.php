<?php

namespace App\gateways;

use App\entities\Checkout;
use App\external\base\IRepository;
use App\interfaces\ICheckoutGateway;
use App\types\EnumCheckout;
use App\types\EnumStatus;


class CheckoutGateway implements ICheckoutGateway
{

    protected Checkout $entity;

    protected String $table = 'checkout';
    protected array $columns = [
        'id',
        'id_pedido',
        'status',
        'gateway_pagamento'
    ];

    protected $repository;

    protected $connection;

    public function __construct($connection, IRepository $repository)
    {
        $this->repository = $repository;
        $this->repository->config($connection, $this->table, $this->columns);
        $this->entity = new Checkout();
        $this->connection = $connection;
    }


    public function create(array $data): Checkout
    {
        $response = $this->repository->create($data);
        (new PedidoGateway($this->connection, $this->repository))->update(
            $data['id_pedido'],
            ['status' => EnumStatus::AGUARDANDO_PAGTO->name]
        );

        return $this->entity->fill($response);
    }

    public function update(int $id, array $data): Checkout
    {
        $response = $this->repository->update($id, $data);
        if(!empty($data['status'])){
            if($data['status'] == EnumCheckout::APROVADO) {
                (new PedidoGateway($this->connection, $this->repository))->update($data['id_pedido'], ['status' => EnumStatus::INCIADO->name]);
            } elseif($data['status'] == EnumCheckout::RECUSADO){
                (new PedidoGateway($this->connection, $this->repository))->update($data['id_pedido'], ['status' => EnumStatus::FINALIZADO->name]);
            }
        }
        return $this->entity->fill($response);
    }

    public function delete(int $id): Checkout
    {
        return $this->entity->fill($this->repository->delete($id));
    }

    public function show(int $id): Checkout
    {
        return $this->entity->fill($this->repository->show($id));
    }

    public function list(): array
    {
        $response = [];
        foreach($this->repository->list() as $row){
            $response[] = (new Checkout())->fill($row);
        }

        return $response;
    }
}