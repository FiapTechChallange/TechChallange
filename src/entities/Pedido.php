<?php

namespace App\entities;


class Pedido extends Entity
{

    public string $id;
    public ?string $id_cliente;

    public DateTime|string $recebimento;
    public DateTime|string|null $fechamento;
    public DateTime|string|null $pagamento;
    public string $status;
    public array|null $itens;
    public array|null $preparo;
    public ?Clientes $cliente;

}