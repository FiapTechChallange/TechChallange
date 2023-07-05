<?php

namespace App\Core\Application\UseCases;

use App\Core\Domain\Entities\Clientes;
use App\Core\Domain\Repositories\IClientesRepository;

class ClientesUseCase implements IClientesUseCase
{

    protected $repository;

    /**
     * @param $repository
     */
    public function __construct(IClientesRepository $repository)
    {
        $this->repository = $repository;
    }


    public function create(array $request): Clientes
    {
        return $this->repository->create($request);
    }

    public function update(int $id, array $request): Clientes
    {
        return $this->repository->update($id, $request);
    }

    public function delete(int $id): Clientes
    {
        return $this->repository->delete($id);
    }

    public function show(int $id): Clientes
    {
        return $this->repository->show($id);
    }

    public function list(): Clientes
    {
        return $this->repository->list();
    }

    public function showByCpf(string $cpf): Clientes
    {
        return $this->repository->list('cpf', $cpf);

    }
}