<?php

namespace App\adapters;

class ShowAdapter
{
    public static function json($response)
    {
        try{
            return json_encode([
                'error' => false,
                'data' => $response
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