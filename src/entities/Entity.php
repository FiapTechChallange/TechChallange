<?php

namespace App\entities;

class Entity
{
    public function fill(array $data)
    {
        foreach($data as $att => $value){
            $this->$att = $value;
        }
        return $this;
    }

    public function toArray()
    {
        $array = [];
        foreach(get_object_vars($this) as $att => $value){
            $array[$att] = $value;
        }
        return $array;
    }
}