<?php

namespace App\usecases;

use App\interfaces\ICardapioUseCase;
use App\entities\Cardapio;
use App\interfaces\ICardapioGateway;

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

    public function update(int $id, array $request): Cardapio
    {
        return $this->gateway->update($id, $request);
    }

    public function delete(int $id): Cardapio
    {
        return $this->gateway->delete($id);
    }

    public function show(int $id): Cardapio
    {
        return $this->gateway->show($id);
    }

    public function list(): array
    {
        return $this->gateway->list();
    }
}