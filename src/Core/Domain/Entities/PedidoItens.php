<?php

namespace App\Core\Domain\Entities;

use App\Adapter\Driven\Infra\Base\BaseEntity;
use App\Adapter\Driven\Infra\Base\EntityFactory;

class PedidoItens extends BaseEntity
{
    use EntityFactory;

    protected static String $table = 'pedido_itens';
    protected static array $columns = [
        'id',
        'id_pedido',
        'id_item_cardapio',
        'observacoes'
    ];

    public int $id;
    public int $id_pedido;
    public int $id_item_cardapio;
    public string $observacoes;

    public array $relations = [
        'id_item_cardapio' => [
            'item' => [
                'entity' => Cardapio::class,
                'column' => 'id'
            ]
        ]
    ];

    private function __construct()
    {
        parent::__construct(self::$table, self::$columns);
    }
}