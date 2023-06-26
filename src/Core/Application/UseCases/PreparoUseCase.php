<?php

namespace App\Core\Application\UseCases;

use App\Core\Domain\Entities\Clientes;
use App\Core\Domain\Entities\Preparo;
use App\Core\Domain\Repositories\IClientesRepository;
use App\Core\Domain\Repositories\IPreparoRepository;

class PreparoUseCase implements IPreparoUseCase
{

    protected $repository;

    /**
     * @param $repository
     */
    public function __construct(IPreparoRepository $repository)
    {
        $this->repository = $repository;
    }


    public function create(array $request): Preparo
    {
        return $this->repository->create($request);
    }

    public function update(int $id, array $request): Preparo
    {
        return $this->repository->update($id, $request);
    }

    public function delete(int $id): Preparo
    {
        return $this->repository->delete($id);
    }

    public function show(int $id): Preparo
    {
        return $this->repository->show($id);
    }

    public function list(): Preparo
    {
        return $this->repository->list();
    }
}