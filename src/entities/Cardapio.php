<?php

namespace App\entities;

class Cardapio extends Entity
{
    public int $id;
    public string $nome;
    public string $descricao;
    public int $id_categoria;
    public string $categoria;
    public float $valor;

}