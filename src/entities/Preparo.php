<?php

namespace App\entities;

use App\Adapter\Driven\Infra\Base\EntityFactory;
use App\external\PdoRepository;
use DateTime;

class Preparo extends Entity
{

    public int $id;
    public int $id_pedido;
    public DateTime $inicio;
    public ?DateTime $termino;

}