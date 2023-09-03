<?php

namespace App\entities;


class Pedido extends Entity
{

    public int $id;
    public ?int $id_cliente;

    public DateTime|string $recebimento;
    public DateTime|string|null $fechamento;
    public DateTime|string|null $pagamento;
    public string $status;
    public ?PedidoItens $itens;
    public ?Preparo $preparo;
    public ?Clientes $cliente;

}