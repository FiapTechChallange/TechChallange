<?php

namespace App\interfaces;

use App\entities\Checkout;

interface ICheckoutGateway
{
    public function create(array $data): Checkout;
    public function update(int $id, array $data): Checkout;
    public function delete(int $id):Checkout;
    public function show(int $id): Checkout;
    public function list(): array;
}