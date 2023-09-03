<?php

namespace App\controllers;

use App\adapters\CreateAdapter;
use App\adapters\DeleteAdapter;
use App\adapters\ListAdapter;
use App\adapters\ShowAdapter;
use App\adapters\UpdateAdapter;
use App\interfaces\IPedidoUseCase;

class PedidoController
{
    public IPedidoUseCase $useCase;

    public function __construct(IPedidoUseCase $useCase)
    {
        $this->useCase = $useCase;
    }


    public function create($request)
    {
        return CreateAdapter::json($this->useCase->create($request));
    }

    public function update($id, $request)
    {
        return UpdateAdapter::json($this->useCase->update($id, $request));
    }

    public function delete($id)
    {
        return DeleteAdapter::json($this->useCase->delete($id));
    }

    public function show($id)
    {
        return ShowAdapter::json($this->useCase->show($id));
    }

    public function list()
    {
        return ListAdapter::json($this->useCase->list());
    }

    public function statusList()
    {
        return ListAdapter::json($this->useCase->statusList());
    }

    public function pedidos()
    {
        return ListAdapter::json($this->useCase->pedidos());
    }


}