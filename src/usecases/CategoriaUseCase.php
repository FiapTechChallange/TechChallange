<?php

namespace App\usecases;

use App\entities\Categoria;
use App\interfaces\ICategoriaGateway;
use App\interfaces\ICategoriaUseCase;

class CategoriaUseCase implements ICategoriaUseCase
{

    protected $gateway;

    public function __construct(ICategoriaGateway $gateway)
    {
        $this->gateway = $gateway;
    }


    public function create(array $request): Categoria
    {
        return $this->gateway->create($request);
    }

    public function update(int $id, array $request): Categoria
    {
        return $this->gateway->update($id, $request);
    }

    public function delete(int $id): Categoria
    {
        return $this->gateway->delete($id);
    }

    public function show(int $id): Categoria
    {
        return $this->gateway->show($id);
    }

    public function list(): array
    {
        return $this->gateway->list();
    }
}