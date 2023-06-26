<?php

namespace App\Core\Application\UseCases;

use App\Core\Domain\Entities\Cardapio;
use App\Core\Domain\Repositories\ICardapioRepository;

class CardapioUseCase implements ICardapioUseCase
{

    protected $repository;

    /**
     * @param $repository
     */
    public function __construct(ICardapioRepository $repository)
    {
        $this->repository = $repository;
    }


    public function create(array $request): Cardapio
    {
        return $this->repository->create($request);
    }

    public function update(int $id, array $request): Cardapio
    {
        return $this->repository->update($id, $request);
    }

    public function delete(int $id): Cardapio
    {
        return $this->repository->delete($id);
    }

    public function show(int $id): Cardapio
    {
        return $this->repository->show($id);
    }

    public function list(): Cardapio
    {
        return $this->repository->list();
    }
}