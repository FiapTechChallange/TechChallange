<?php

namespace App\entities;

class Cardapio extends Entity
{
    public string $id;
    public string $nome;
    public string $descricao;
    public string $id_categoria;
    public string $categoria;
    public float $valor;

}