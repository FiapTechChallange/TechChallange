<?php

namespace App\Adapter\Driver\Api\Controllers;

use App\Core\Application\UseCases\IClientesUseCase;
use App\Core\Application\UseCases\IPreparoUseCase;

class PreparoController
{
    public IPreparoUseCase $useCase;

    public function __construct(IPreparoUseCase $useCase)
    {
        $this->useCase = $useCase;
    }


    public function create($request)
    {
        return json_encode($this->useCase->create($request));
    }

    public function update($id, $request)
    {
        return json_encode($this->useCase->update($id, $request));
    }

    public function delete($id)
    {
        return json_encode($this->useCase->delete($id));
    }

    public function show($id)
    {
        return json_encode($this->useCase->show($id));
    }

    public function list()
    {
        return json_encode($this->useCase->list());
    }


}