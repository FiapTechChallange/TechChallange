<?php

namespace App\usecases;

use App\entities\Checkout;
use App\interfaces\ICheckoutGateway;

class CheckoutUseCase implements \App\interfaces\ICheckoutUseCase
{

    protected $gateway;

    public function __construct(ICheckoutGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function create(array $request): Checkout
    {
        return $this->gateway->create($request);
    }

    public function update(int $id, array $request): Checkout
    {
        return $this->gateway->update($id, $request);
    }

    public function delete(int $id): Checkout
    {
        return $this->gateway->delete($id);
    }

    public function show(int $id): Checkout
    {
        return $this->gateway->show($id);
    }

    public function list(): array
    {
        return $this->gateway->list();
    }
}