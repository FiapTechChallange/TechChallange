<?php

namespace App\types;


enum EnumGatewaysPagto: string
{
    case MERCADO_PAGO = 'Mercado Pago';
    case PAYPAL = 'Paypal';

    public static function getList(): array
    {
        return array_combine(
            array_column(self::cases(), 'name'),
            array_column(self::cases(), 'value')
        );
    }
}
