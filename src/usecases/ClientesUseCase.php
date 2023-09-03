<?php

namespace App\usecases;

use App\entities\Clientes;
use App\interfaces\IClientesGateway;
use App\interfaces\IClientesUseCase;

class ClientesUseCase implements IClientesUseCase
{

    protected $gateway;

    public function __construct(IClientesGateway $gateway)
    {
        $this->gateway = $gateway;
    }


    public function create(array $request): Clientes
    {
        return $this->gateway->create($request);
    }

    public function update(int $id, array $request): Clientes
    {
        return $this->gateway->update($id, $request);
    }

    public function delete(int $id): Clientes
    {
        return $this->gateway->delete($id);
    }

    public function show(int $id): Clientes
    {
        return $this->gateway->show($id);
    }

    public function list(): array
    {
        return $this->gateway->list();
    }

    public function showByCpf(string $cpf): Clientes
    {
        $cliente = $this->gateway->list('cpf', $cpf);
        if(!empty($cliente)){
            return $cliente[0];
        }
        return new Clientes();

    }
}