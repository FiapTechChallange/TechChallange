<?php

namespace App\Core\Domain\Entities;

use App\Adapter\Driven\Infra\Base\BaseEntity;
use App\Adapter\Driven\Infra\Base\EntityFactory;

class Categoria extends BaseEntity
{
    use EntityFactory;

    protected static String $table = 'categoria';
    protected static array $columns = [
        'id',
        'nome'
    ];

    public int $id;
    public string $nome;

    private function __construct()
    {
        parent::__construct(self::$table, self::$columns);
    }
}