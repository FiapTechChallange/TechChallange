<?php

namespace App\types;


enum EnumStatus: string
{
    case AGUARDANDO_PAGAMENTO = 'aguardando pagamento';
    case INCIADO = 'inciado';
    case RECEBIDO = 'recebido';
    case EM_PREPARACAO = 'em preparação';
    case PRONTO = 'pronto';
    case FINALIZADO = 'finalizado';

    public static function getList(): array
    {
        return array_combine(
            array_column(self::cases(), 'name'),
            array_column(self::cases(), 'value')
        );
    }
}
