<?php

namespace App\usecases;

use App\interfaces\ICardapioUseCase;
use App\entities\Cardapio;
use App\interfaces\ICardapioGateway;
use App\types\EnumCategorias;

class CardapioUseCase implements ICardapioUseCase
{

    protected $gateway;

    public function __construct(ICardapioGateway $gateway)
    {
        $this->gateway = $gateway;
    }


    public function create(array $request): Cardapio
    {
        return $this->gateway->create($request);
    }

    public function update(string $id, array $request): Cardapio
    {
        return $this->gateway->update($id, $request);
    }

    public function delete(string $id): Cardapio
    {
        return $this->gateway->delete($id);
    }

    public function show(string $id): Cardapio
    {
        return $this->gateway->show($id);
    }

    public function list(): array
    {
        return $this->gateway->list();
    }

    public function categoriasList(): array
    {
        return EnumCategorias::getList();
    }

    public function listByCategoria(string $categoria): array
    {
        return $this->gateway->listByCategoria($categoria);
    }
}