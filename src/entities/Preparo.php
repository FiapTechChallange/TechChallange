<?php

namespace App\entities;

class Preparo extends Entity
{

    public int $id;
    public int $id_pedido;
    public DateTime $inicio;
    public ?DateTime $termino;

}