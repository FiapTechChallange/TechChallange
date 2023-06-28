<?php

namespace App\Core\Application\UseCases;

use App\Core\Domain\Entities\Categoria;
use App\Core\Domain\Repositories\ICategoriaRepository;

class CategoriaUseCase implements ICategoriaUseCase
{

    protected $repository;

    /**
     * @param $repository
     */
    public function __construct(ICategoriaRepository $repository)
    {
        $this->repository = $repository;
    }


    public function create(array $request): Categoria
    {
        return $this->repository->create($request);
    }

    public function update(int $id, array $request): Categoria
    {
        return $this->repository->update($id, $request);
    }

    public function delete(int $id): Categoria
    {
        return $this->repository->delete($id);
    }

    public function show(int $id): Categoria
    {
        return $this->repository->show($id);
    }

    public function list(): Categoria
    {
        return $this->repository->list();
    }
}