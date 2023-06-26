<?php

namespace App\Adapter\Driven\Infra\Base;

trait EntityFactory
{
    private static ?self $model = null;
    
    public static function model()
    {
        if (is_null(self::$model)){
            self::$model = new static(self::$table);
        }
        
        return self::$model;
    }
}