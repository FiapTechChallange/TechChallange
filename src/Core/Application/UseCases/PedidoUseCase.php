<?php

namespace App\Core\Application\UseCases;

use App\Core\Domain\Base\EnumStatus;
use App\Core\Domain\Entities\Pedido;
use App\Core\Domain\Repositories\IPedidoRepository;

class PedidoUseCase implements IPedidoUseCase
{

    protected $repository;

    /**
     * @param $repository
     */
    public function __construct(IPedidoRepository $repository)
    {
        $this->repository = $repository;
    }


    public function create(array $request): Pedido
    {
        return $this->repository->create($request);
    }

    public function update(int $id, array $request): Pedido
    {
        return $this->repository->update($id, $request);
    }

    public function delete(int $id): Pedido
    {
        return $this->repository->delete($id);
    }

    public function show(int $id): Pedido
    {
        return $this->repository->show($id);
    }

    public function list(): Pedido
    {
        return $this->repository->list();
    }

    public function statusList(): array
    {
        return EnumStatus::getList();
    }
}