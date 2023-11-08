<?php

namespace App\external\base;

interface Connection
{
    public static function getInstance(array $connectionData): self;

}