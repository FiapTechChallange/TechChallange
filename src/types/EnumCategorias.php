<?php

namespace App\types;


enum EnumCategorias: string
{
    case LANCHES = 'lanches';
    case ACOMPANHAMENTOS = 'acompanhamentos';
    case BEBIDAS = 'bebidas';

    case SOBREMESAS = 'Sobremesas';

    public static function getList(): array
    {
        return array_combine(
            array_column(self::cases(), 'name'),
            array_column(self::cases(), 'value')
        );
    }
}
