<?php

namespace App\Core\Domain\Entities;

use App\Adapter\Driven\Infra\Base\BaseEntity;
use App\Adapter\Driven\Infra\Base\EntityFactory;
use DateTime;

class Preparo extends BaseEntity
{
    use EntityFactory;

    protected static String $table = 'preparo';
    protected static array $columns = [
        'id',
        'id_pedido',
        'inicio',
        'termino'
    ];

    public int $id;
    public int $id_pedido;
    public DateTime $inicio;
    public DateTime $termino;

    private function __construct()
    {
        parent::__construct(self::$table, self::$columns);
    }
}