<?php

namespace App\Core\Domain\Entities;

use App\Adapter\Driven\Infra\Base\BaseEntity;
use App\Adapter\Driven\Infra\Base\EntityFactory;

class Cardapio extends BaseEntity
{
    use EntityFactory;

    protected static String $table = 'cardapio';
    protected static array $columns = [
        'id',
        'nome',
        'descricao',
        'id_categoria',
        'valor'
    ];

    public int $id;
    public string $nome;
    public string $descricao;
    public int $id_categoria;
    public string $categoria;
    public float $valor;

    private function __construct()
    {
        parent::__construct(self::$table, self::$columns);
    }
}