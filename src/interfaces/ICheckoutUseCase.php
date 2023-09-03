<?php

namespace App\interfaces;

use App\entities\Checkout;

interface ICheckoutUseCase
{
    public function create(array $request): Checkout;
    public function update(int $id, array $request): Checkout;
    public function delete(int $id): Checkout;
    public function show(int $id): Checkout;
    public function list(): array;
}