<?php

namespace App\entities;

class Categoria extends Entity
{
    public int $id;
    public string $nome;

    public array $itensCardapio;

}