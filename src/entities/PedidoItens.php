<?php

namespace App\entities;

use App\Adapter\Driven\Infra\Base\EntityFactory;
use App\external\PdoRepository;

class PedidoItens extends Entity
{

    public int $id;
    public int $id_pedido;
    public int $id_item_cardapio;
    public string $observacoes;
    public string $total;

}