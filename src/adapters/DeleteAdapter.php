<?php

namespace App\adapters;

class DeleteAdapter
{
    public static function json($response)
    {
        try{
            return json_encode([
                'error' => false,
                'code' => 204
            ]);

        } catch (\Exception $e) {
            return json_encode([
                'error' => true,
                'status' => $e->getCode(),
                'msg' => $e->getMessage()
            ]);
        }
    }
}