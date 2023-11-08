<?php

namespace App\types;


enum EnumCheckout: string
{
    case INICIADO = 'iniciado';
    case APROVADO = 'aprovado';
    case RECUSADO = 'recusado';

    public static function getList(): array
    {
        return array_combine(
            array_column(self::cases(), 'name'),
            array_column(self::cases(), 'value')
        );
    }

    public function pedidoStatus()
    {
        return match($this) {
            EnumCheckout::INICIADO => EnumStatus::AGUARDANDO_PAGTO,
            EnumCheckout::APROVADO => EnumStatus::AGUARDANDO_PREPARO,
            EnumCheckout::RECUSADO => EnumStatus::FINALIZADO
        };
    }
}
