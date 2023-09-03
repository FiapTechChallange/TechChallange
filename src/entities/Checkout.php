<?php

namespace App\entities;

class Checkout extends Entity
{

    public int $id;
    public int $id_pedido;

    public string $status;

    public string $gateway_pagamento;

}