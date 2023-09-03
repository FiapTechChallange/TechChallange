<?php

namespace App\usecases;


use App\entities\Preparo;
use App\interfaces\IPreparoGateway;
use App\interfaces\IPreparoUseCase;

class PreparoUseCase implements IPreparoUseCase
{

    protected $gateway;

    public function __construct(IPreparoGateway $gateway)
    {
        $this->gateway = $gateway;
    }


    public function create(array $request): Preparo
    {
        return $this->gateway->create($request);
    }

    public function update(int $id, array $request): Preparo
    {
        return $this->gateway->update($id, $request);
    }

    public function delete(int $id): Preparo
    {
        return $this->gateway->delete($id);
    }

    public function show(int $id): Preparo
    {
        return $this->gateway->show($id);
    }

    public function list(): array
    {
        return $this->gateway->list();
    }
}