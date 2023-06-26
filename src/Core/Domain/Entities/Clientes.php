<?php

namespace App\Core\Domain\Entities;

use App\Adapter\Driven\Infra\Base\BaseEntity;
use App\Adapter\Driven\Infra\Base\EntityFactory;

class Clientes extends BaseEntity
{
    use EntityFactory;

    protected static String $table = 'clientes';
    protected static array $columns = [
        'id',
        'nome',
        'email',
        'telefone'
    ];

    public int $id;
    public string $nome;
    public string $email;
    public string $telefone;

    private function __construct()
    {
        parent::__construct(self::$table, self::$columns);
    }
}