<?php

namespace App\Core\Domain\Entities;

use App\Adapter\Driven\Infra\Base\BaseEntity;
use App\Adapter\Driven\Infra\Base\EntityFactory;
use DateTime;

class Pedido extends BaseEntity
{
    use EntityFactory;

    protected static String $table = 'pedido';
    protected static array $columns = [
        'id',
        'id_cliente',
        'fechamento',
        'pagamento',
        'status'
    ];

    public int $id;
    public ?int $id_cliente;
    public ?DateTime $fechamento;
    public ?DateTime $pagamento;
    public string $status;
    public ?PedidoItens $itens;
    public ?Preparo $preparo;
    public ?Clientes $cliente;

    private function __construct()
    {
        parent::__construct(self::$table, self::$columns);
    }
}