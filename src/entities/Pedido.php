<?php

namespace App\entities;

use App\Adapter\Driven\Infra\Base\EntityFactory;
use App\external\PdoRepository;
use DateTime;

class Pedido extends Entity
{

    public int $id;
    public ?int $id_cliente;
    public DateTime|string|null $fechamento;
    public DateTime|string|null $pagamento;
    public string $status;
    public ?PedidoItens $itens;
    public ?Preparo $preparo;
    public ?Clientes $cliente;

}