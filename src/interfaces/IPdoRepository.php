<?php

namespace App\interfaces;

interface IPdoRepository
{
    public function config($connection, $table, $columns);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function show(int $id);
    public function list();

}