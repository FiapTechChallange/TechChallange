<?php

namespace App\Core\Application\UseCases;

use App\Core\Domain\Entities\PedidoItens;
use App\Core\Domain\Repositories\IPedidoItensRepository;

class PedidoItensUseCase implements IPedidoItensUseCase
{

    protected $repository;

    /**
     * @param $repository
     */
    public function __construct(IPedidoItensRepository $repository)
    {
        $this->repository = $repository;
    }


    public function create(array $request): PedidoItens
    {
        return $this->repository->create($request);
    }

    public function update(int $id, array $request): PedidoItens
    {
        return $this->repository->update($id, $request);
    }

    public function delete(int $id): PedidoItens
    {
        return $this->repository->delete($id);
    }

    public function show(int $id): PedidoItens
    {
        return $this->repository->show($id);
    }

    public function list(): PedidoItens
    {
        return $this->repository->list();
    }
}